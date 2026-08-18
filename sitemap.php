<?php
require_once __DIR__ . '/includes/functions.php';
header('Content-Type: application/xml; charset=utf-8');
$urls=[site_url('index.php'),site_url('about.php'),site_url('services.php'),site_url('blogs.php'),site_url('contact.php')];
foreach(db()['blogs'] as $b) if(($b['status']??'')==='published') $urls[]=site_url('blog-detail.php?slug='.urlencode($b['slug']));
foreach(['homeopathy-treatment','child-care','women-health','skin-problems','hair-problems','allergy-treatment','lifestyle-disorders'] as $s)$urls[]=site_url('services/'.$s.'.php');
echo '<?xml version="1.0" encoding="UTF-8"?>'."\n";
echo '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">';
foreach($urls as $u) echo '<url><loc>'.htmlspecialchars($u,ENT_XML1).'</loc></url>';
echo '</urlset>';
