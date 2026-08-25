<?php
if (session_status() === PHP_SESSION_NONE) session_start();
function db_load(): array { $data = include __DIR__ . '/db.php'; return is_array($data) ? $data : []; }
function db_save(array $data): void { $php = "<?php\n// FILE-BASED DATABASE: No MySQL / SQL is used.\nreturn " . var_export($data, true) . ";\n"; file_put_contents(__DIR__ . '/db.php', $php, LOCK_EX); }
function default_db(): array { return ['settings'=>[],'patients'=>[],'appointments'=>[],'inquiries'=>[],'blogs'=>[],'gallery'=>[]]; }
function next_number(array $items, string $prefix): string { $max=0; foreach($items as $item){$n=$item['number']??'';if(preg_match('/(\d+)$/',$n,$m))$max=max($max,(int)$m[1]);} return $prefix.str_pad((string)($max+1),6,'0',STR_PAD_LEFT); }
function e($value): string { return htmlspecialchars((string)$value, ENT_QUOTES, 'UTF-8'); }
function redirect(string $url): never { header('Location: '.$url); exit; }
function post(string $key,$default=''){return $_POST[$key]??$default;}
function get(string $key,$default=''){return $_GET[$key]??$default;}
function now_iso(): string {return date('Y-m-d H:i:s');}
function upload_image(string $field,string $dir='uploads'): string { if(empty($_FILES[$field]['name'])||$_FILES[$field]['error']!==UPLOAD_ERR_OK)return ''; $allowed=['jpg','jpeg','png','webp','gif'];$ext=strtolower(pathinfo($_FILES[$field]['name'],PATHINFO_EXTENSION));if(!in_array($ext,$allowed,true)||$_FILES[$field]['size']>5*1024*1024)return ''; $name=date('YmdHis').'_'.bin2hex(random_bytes(4)).'.'.$ext;$root=__DIR__.'/'.$dir;if(!is_dir($root))mkdir($root,0775,true);move_uploaded_file($_FILES[$field]['tmp_name'],$root.'/'.$name);return $dir.'/'.$name; }
function settings(): array { $db=db_load(); return $db['settings']??[]; }
function admin_required(): void { if(empty($_SESSION['admin_logged_in']))redirect('login.php'); }
function find_item(array $items,string $id): ?array {foreach($items as $item)if(($item['id']??'')===$id)return $item;return null;}
function make_id(): string{return bin2hex(random_bytes(8));}
function date_fmt($date): string{return $date?date('d M Y',strtotime($date)):'-';}
