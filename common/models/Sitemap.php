<?php
namespace common\models;

use Yii;
use yii\base\Model;
use yii\helpers\Url;

class Sitemap extends Model{
    public function getUrl(){
        //$urls = Yii::$app->urlManager->rules;

        $urls = array();
        //Формируем двумерный массив. createUrl преобразует ссылки в правильный вид.
        //Добавляем элемент массива 'daily' для указания периода обновления контента

        foreach (Yii::$app->urlManager->rules as $url_rule){
            $test = str_replace('<','',$url_rule->route);
            if($test == $url_rule->route) {
                $test = str_replace('gii','',$url_rule->route);
                if($test == $url_rule->route) {
                    //$baseURL = Url::base(true);
                    $test = str_replace('site/index','',$url_rule->route);
                    if($test != '') {
                        $urls[] = array(Yii::$app->urlManager->createUrl([$url_rule->route]), 'daily');
                    }
                }
            }
        }
        return $urls;
    }
    public function getXml($urls){
        $host = Yii::$app->request->hostInfo; // домен сайта
        ob_start();
        echo '<?xml version="1.0" encoding="UTF-8"?>'."\r\n"; ?>
        <urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
            <url>
                <loc><?= $host ?></loc>
                <changefreq>daily</changefreq>
                <priority>1</priority>
            </url>
            <?php foreach($urls as $url): ?>
                <url>
                    <loc><?= $host.$url[0] ?></loc>
                    <changefreq><?= $url[1] ?></changefreq>
                </url>
            <?php endforeach; ?>
        </urlset>
        <?php return ob_get_clean();
    }
    public function showXml($xml_sitemap){
        // устанавливаем формат отдачи контента
        Yii::$app->response->format = \yii\web\Response::FORMAT_XML;
        //повторно т.к. может не сработать
        header("Content-type: text/xml");
        echo $xml_sitemap;
        Yii::$app->end();
    }
}
