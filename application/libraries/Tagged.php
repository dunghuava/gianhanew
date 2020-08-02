<?php
class Tagged
{
	// Khai bao
	public $CI;
	public $taggable_type;
	public $taggable_id;
	public $controller;
	public $tagging_tags   = 'tagging_tags';
	public $tagging_tagged = 'tagging_tagged';

	function __construct($config = "")
	{
		$this->CI =& get_instance();
		if($config != ""){
			$this->setOption($config);
		}
	}
	public function setOption($config){
		foreach($config as $k=>$value){
			$method="set".ucfirst($k);
			$this->$method($value);
		}
	}
	/*public function setTagging_tags($tagging_tags){
		$this->tagging_tags = $tagging_tags;
	}
	public function setTagging_tagged($tagging_tagged){
		$this->tagging_tags = $tagging_tagged;
	}*/
	public function setTaggable_id($taggable_id)
	{
		$this->taggable_id = $taggable_id;
	}
	public function setTaggable_type($taggable_type)
	{
		$this->taggable_type = $taggable_type;
	}
	/**
	 * Perform the action of tagging the model with the given string
	 *
	 * @param $tagName string or array
	 */
	public function tag($tagNames) {
		$tagNames = $this->makeTagArray($tagNames);
		foreach($tagNames as $tagName) {
			$this->addTag($tagName);
		}
	}

	// Them tag
	private function addTag($tagName) {
		$tagName = trim($tagName);
		$tagSlug = $this->slug($tagName);
		$previousCount = $this->CI->db->where(['tag_slug'=>$tagSlug ,'taggable_id' => $this->taggable_id,'taggable_type'=>$this->taggable_type])->get($this->tagging_tagged)->num_rows();
		if($previousCount >= 1) { return; }
		$tagged = array(
			'taggable_id'   => $this->taggable_id,
			'taggable_type' => $this->taggable_type,
			'tag_name'	    => $tagName,
			'tag_slug'      => $tagSlug,
		);
		$this->CI->db->insert($this->tagging_tagged,$tagged);
		$this->incrementCount($tagName,$tagSlug,1);
	}
	/**
	 * Remove the tag from this model
	 *
	 * @param $tagName string or array (or null to remove all tags)
	 */
	public function untag($tagNames=null) {
		if(is_null($tagNames)) {
			$currentTagNames = $this->tagNames();
			foreach($currentTagNames as $tagName) {
				$this->removeTag($tagName);
			}
			return;
		}
		$tagNames = $this->makeTagArray($tagNames);
		foreach($tagNames as $tagName) {
			$this->removeTag($tagName);
		}
	}
	
	/**
	 * Replace the tags from this model
	 *
	 * @param $tagName string or array
	 */
	public function retag($tagNames) {
		$tagNames = $this->makeTagArray($tagNames);
		$currentTagNames = $this->tagNames();
		$deletions = array_diff($currentTagNames, $tagNames);
		$additions = array_diff($tagNames, $currentTagNames);
		foreach($deletions as $tagName) {
			$this->removeTag($tagName);
		}
		foreach($additions as $tagName) {
			$this->addTag($tagName);
		}
	}
	/**
	 * Removes a single tag
	 *
	 * @param $tagName string
	 */
	private function removeTag($tagName) {
		$tagName = trim($tagName);
		$tagSlug = $this->slug($tagName);
		$count = $this->CI->db->where(['tag_slug' => $tagSlug ,'taggable_id' => $this->taggable_id ,'taggable_type' => $this->taggable_type])->get($this->tagging_tagged)->row();
		if (!empty($count)) {
			$this->decrementCount($tagName, $tagSlug, 1);
			$this->CI->db->where(['id'=>$count->id])->delete($this->tagging_tagged);
		}
		return $count;
	}
	/**
	 * Return array of the tag names related to the current model
	 *
	 * @return array
	 */
	public function tagNames() {
		$tagNames = array();
		$tagged = $this->CI->db->where([$this->tagging_tagged.'.taggable_type' => $this->taggable_type,$this->tagging_tagged.'.taggable_id' => $this->taggable_id])
							   ->get($this->tagging_tagged)
							   ->result();
		foreach($tagged as $tagged) {
			$tagNames[] = $tagged->tag_name;
		}
		return $tagNames;
	}
	/**************************************************--HAM HO TRO--*********************************************************/
	/**
	 * Private! Please do not call this function directly, just let the Tag library use it.
	 * Increment count of tag by one. This function will create tag record if it does not exist.
	 *
	 * @param string $tagString
	 */
	private function incrementCount($tagString, $tagSlug, $count) {
		if($count <= 0) { return; }
		$tag = $this->CI->db->where('slug', $tagSlug)->get($this->tagging_tags)->row();
		if(!$tag) {
			$tags = [
				'name'	 => $tagString,
				'slug'   => $tagSlug,
				'suggest'=> false,
				'count'  => $count
			];
			$this->CI->db->insert($this->tagging_tags,$tags);
		}else{
			$this->CI->db->where('id',$tag->id)->update($this->tagging_tags,['count' => $tag->count + $count]);
		}
		
	}
	/**
	 * Private! Please do not call this function directly, let the Tag library use it.
	 * Decrement count of tag by one. This function will create tag record if it does not exist.
	 *
	 * @param string $tagString
	 */
	public function decrementCount($tagString, $tagSlug, $count) {
		if($count <= 0) { return; }
		$tag = $this->CI->db->where('slug',$tagSlug)->get($this->tagging_tags)->row();
		if($tag) {
			$count = $tag->count - $count;
			if($count < 0) {
				$count = 0;
			}
			$this->CI->db->where('id',$tag->id)->update($this->tagging_tags,['count' => $count]);
		}
	}
	
	public function slug($str) {
		$str = trim(mb_strtolower($str));
	    $str = preg_replace('/(à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ)/', 'a', $str);
	    $str = preg_replace('/(è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ)/', 'e', $str);
	    $str = preg_replace('/(ì|í|ị|ỉ|ĩ)/', 'i', $str);
	    $str = preg_replace('/(ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ)/', 'o', $str);
	    $str = preg_replace('/(ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ)/', 'u', $str);
	    $str = preg_replace('/(ỳ|ý|ỵ|ỷ|ỹ)/', 'y', $str);
	    $str = preg_replace('/(đ)/', 'd', $str);
	    $str = preg_replace('/[^a-z0-9-\s]/', '', $str);
	    $str = preg_replace('/([\s]+)/', '-', $str);
	    return $str;
	}
	/**
	 * Converts input into array
	 *
	 * @param $tagName string or array
	 * @return array
	 */
	public function makeTagArray($tagNames) {
		if(is_string($tagNames)) {
			$tagNames = explode(',', $tagNames);
		} elseif(!is_array($tagNames)) {
			$tagNames = array(null);
		}
		
		$tagNames = array_map('trim', $tagNames);
		return $tagNames;
	}
}
