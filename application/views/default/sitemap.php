<?= '<?xml version="1.0" encoding="UTF-8" ?>' ?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" xmlns:image="http://www.google.com/schemas/sitemap-image/1.1" xmlns:news="http://www.google.com/schemas/sitemap-news/0.9"> 
    <url>
        <loc><?= base_url();?></loc> 
        <image:image>
            <image:loc><?= LOGOSITE; ?></image:loc> 
        </image:image>
    </url>
    <?php
    if (!empty($data['categories'])){
        foreach($data['categories'] as $categorie){
    ?>
    <url>
        <loc><?= $categorie['link'];?></loc>
    </url>
    <?php
        }
    }
    if (!empty($data['cate_province'])){
        foreach($data['cate_province'] as $cate_province){
    ?>
    <url>
        <loc><?= $cate_province;?></loc>
    </url>
    <?php
        }
    }
    if (!empty($data['districts'])){
        foreach($data['districts'] as $district){
    ?>
    <url>
        <loc><?= $district;?></loc>
    </url>
    <?php
        }
    }
    ?>
    <?php
    if (!empty($data['articles'])){
        foreach($data['articles'] as $article){
    ?>
    <url>
        <loc><?= $article['link'];?></loc>
    </url>
    <?php
        }
    }
    ?>
    <?php
    if (!empty($data['tags'])) {
       foreach($data['tags'] as $tag){
    ?>
    <url>
        <loc><?= $tag['link'];?></loc>
    </url>
    <?php
        }
    }
    if (!empty($data['realestates'])) {
       foreach($data['realestates'] as $realestate){
    ?>
    <url>
        <loc><?= $realestate;?></loc>
    </url>
    <?php
        }
    }
    ?>
    
    <!-- TAG -->
    <?php
    if (!empty($data['pages'])){
        foreach($data['pages'] as $page){
    ?>
    <url>
        <loc><?= $page['link'];?></loc>
    </url>
    <?php
        }
    }
    ?>
</urlset>