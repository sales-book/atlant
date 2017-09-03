<?php

/* @var $this yii\web\View */

$this->title = Yii::$app->params['shortName'] . " - купить кассовый аппарат ККТ, модернизация ККТ, обновить кассу";
$this->registerMetaTag([
	'name' => 'description',
	'content' => 'Купить кассу, установка и сервисное обслуживание контрольно-кассового оборудования по всей России. Звоните!'
]);
$this->registerMetaTag([
	'name' => 'keywords',
	'content' => 'купить ККТ, купить ККМ, купить кассу недорого, модернизация ККТ, модернизация ККМ, 54 ФЗ, обновить кассу, купить кассу, обновить кассовый аппарат, обновить кассу, купить кассу, купить кассовый аппарат, новые кассы, требования к кассам'
]);

?>

<style>
.frame {
  position: relative;
}
.ad {
  position: absolute;
  left: 0px;
  top: 0px;
  right: 0px;
  bottom: 0px;
  z-index: 2;

}
h2, h3{
	color: white;
}
.back{
  position: absolute;
  background: gray;
  opacity: 0.4;
    left: 0px;
  top: 0px;
  right: 0px;
  bottom: 0px;
}  
</style>
<div class="site-index">

    <div class="jumbotron">



        <?php
            if (!Yii::$app->user->isGuest) {
                $start_url = 'lk';
            } else{
                $start_url = 'login';
            }
        ?>

		<div class="frame">
			<iframe src="https://www.youtube.com/embed/Im-qxQL0ZYo?autoplay=1&loop=1&enablejsapi=1&&playerapiid=featuredytplayer&controls=0&modestbranding=1&rel=0&showinfo=0&color=white&iv_load_policy=3&theme=light&wmode=transparent"
				frameborder="0" id="widget2"
				style="z-index: 0; height: 789px; width: 1400px; margin-top: -120px; margin-left: -200px;">
			</iframe>
			<div class="back" style="z-index: 1; height: 789px; width: 1400px; margin-top: -120px; margin-left: -200px;"></div>	
			<div class="ad">
			<h2>Модернизация, установка и запуск</h2>
			<h2>контрольно-кассового оборудования</h2>
			<h2>по всей России</h2>
			<br>
				<p><a class="btn btn-lg btn-success" href="<?= $start_url ?>">
				<?php
					if (!Yii::$app->user->isGuest) {
						echo "Перейти в личный кабинет партнера";
					} else{
						echo "Войти в личный кабинет партнера";
					}
				?>		
				</a></p>
				<h3>с гарантийным и пост-гарантийным обслуживанием</h3>
				<h3>Фискальные накопители есть в наличии</h3>
				<br><br>
				<a class="btn btn-lg btn-primary" style="margin: 5px;" href="#installation">Установка и запуск ККМ</a>
				
				<a class="btn btn-lg btn-primary" style="margin: 5px;" href="#modernization">&nbsp;&nbsp;&nbsp;&nbsp;Модернизация ККМ&nbsp;&nbsp;&nbsp;&nbsp;</a>

			</div>	
		</div>		

		<a name="modernization"></a>
		<div style="padding-top: 40px;">
			<h1>Модернизация<br>
			кассового оборудования</h1>
			<p>Не спешите избавляться от старой контрольно-кассовой техники, которая не соответствует новым требованиям 54-ФЗ!</p>
			<p>Мы поможем вам модернизировать контрольно-кассовое оборудование и сэкономить деньги!</p>
			<br>
			<p style="font-size: 14px;">Мы предоставляем услугу выезда специалиста для аудита вашей техники <br>и составления подробных рекомендаций по её обновлению.</p> 
			<p style="font-size: 14px;">Вам это ничего не стоит. </p>
		</div>
		<a name="installation"></a>
		<div style="padding-top: 40px;">
			<h1>Установка и запуск<br>
			контрольно-кассового оборудования</h1>
			<p>Наша специализация — это установка, запуск и обслуживание оборудования для автоматизации торговли. </p>
			<p>Мы устанавливаем в торговые точки всё: начиная с простых пин-падов заканчивая сложными POS-терминалами с весами, кассами и дисплеями. </p>
			<br>
			<div class="row">
				<div class="col-sx-12 col-sm-12 col-md-6 col-lg-6">Мы — официальный сервисный партнер ведущих производителей кассового оборудования</div>
				<div class="col-sx-12 col-sm-12 col-md-6 col-lg-6">Это позволяет нам выполнять запуск и проводить гарантийное и пост-гарантийное обслуживание кассового оборудования и программного обеспечения ведущих российских производителей оборудования и программного обеспечения для автоматизации торговли, общественного питания и сферы услуг.</div>
			</div> 
			<div class="row">
				<div class="col-sx-12 col-sm-4 col-md-4 col-lg-4" >
					<div style="height: 150px;">
						<img src="img/atollogo1.png">
					</div>
					<div>
						<p>Официальный сервисный партнёр AТОЛ</p>
					</div>
				</div>
				<div class="col-sx-12 col-sm-4 col-md-4 col-lg-4" >
					<div  style="height: 150px;">
						<img src="img/shtrikhlogo1.png">
					</div>
					<div>
						<p>Официальный сервисный партнёр Штрих-М</p>
					</div>
				</div>
				<div class="col-sx-12 col-sm-4 col-md-4 col-lg-4" >
					<div  style="height: 150px;">
						<img src="img/partnerslogos.jpg">
					</div>
					<div>
						<p>Официальный сервисный партнёр ЭВОТОР</p>
					</div>
				</div>				
			</div>
		</div>
		<a name="catalogkkm"></a>
		<div style="padding-top: 40px;">
			<h1>Купить ККТ<br>
			<h1>Каталог контрольно-кассового<br>
			оборудования </h1>
			<p>Ищите где недорого купить кассовый аппарат? <br>
Мы с радостью подберем для вас оптимальный вариант.</p>
			<p>В нашем каталоге около 300 наименований оборудования, подходящего для разных целей и предназначенного для разных задач. <br>
Все цены — закупочные, поэтому у нас вы можете купить ККМ недорого.
Фискальные накопители есть в наличии.</p>
		</div>
		<style>
		#catalog p {
			margin-bottom: 0;
			font-size: 18px;
			font-weight: bold;
		}
		</style>
		<div id="catalog">
			<div class="row" >
				<div class="col-sx-12 col-sm-3 col-md-3 col-lg-3" >
					<div style="height: 150px;">
						<img src="img/kkm/atol1.jpg" height="150">
					</div>
					<div>
						<p>АТОЛ 90Ф</p>
						Современный и удобный контрольно-кассовый аппарат для предприятий с небольшим потоком клиентов.<br>
						<p>18 000р.</p>
						<a class="btn btn-sm btn-primary" style="margin: 5px;" href="buy-kkt?model=atol-90f">Купить ККТ</a>
					</div>
				</div>
				<div class="col-sx-12 col-sm-3 col-md-3 col-lg-3" >
					<div  style="height: 150px;">
						<img src="img/kkm/atol2.jpg" height="150">
					</div>
					<div>
						<p>АТОЛ 55Ф</p>
						Высокая скорость работы позволяет применять устройство в точках с большим потоком покупателей.<br>
						<p>31 000р.</p>
						<a class="btn btn-sm btn-primary" style="margin: 5px;" href="buy-kkt?model=atol-55f">Купить ККТ</a>
					</div>
				</div>
				<div class="col-sx-12 col-sm-3 col-md-3 col-lg-3" >
					<div  style="height: 150px;">
						<img src="img/kkm/atol3.jpg" height="150">
					</div>
					<div>
						<p>АТОЛ 11Ф</p>
						Контрольно-кассовая техника нового поколения, идеально в 2017 году. Устройство полностью соответствует новым требованиям 54ФЗ.<br>
						<p>26 000р.</p>
						<a class="btn btn-sm btn-primary" style="margin: 5px;" href="buy-kkt?model=atol-11f">Купить ККТ</a>
					</div>
				</div>				
				<div class="col-sx-12 col-sm-3 col-md-3 col-lg-3" >
					<div  style="height: 150px;">
						<img src="img/kkm/atol4.jpg" height="150">
					</div>
					<div>
						<p>АТОЛ 30Ф</p>
						Компактная модель отлично подходит для торговых точек, предприятий и магазинов небольшого формата.<br>
						<p>21 000р.</p>
						<a class="btn btn-sm btn-primary" style="margin: 5px;" href="buy-kkt?model=atol-30f">Купить ККТ</a>
					</div>
				</div>				
			</div>
			<div class="row" >
				<div class="col-sx-12 col-sm-3 col-md-3 col-lg-3" >
					<div style="height: 150px;">
						<img src="img/kkm/elves_mf_1.jpg" height="150">
					</div>
					<div>
						<p>ККТ «ЭЛВЕС-МФ»</p>
						Отлично себя зарекомендовавшая портативная кассовая машина от Компании «ШТРИХ-М».<br>
						<p>19 000р.</p>
						<a class="btn btn-sm btn-primary" style="margin: 5px;" href="buy-kkt?model=elves-mf">Купить ККТ</a>
					</div>
				</div>
				<div class="col-sx-12 col-sm-3 col-md-3 col-lg-3" >
					<div  style="height: 150px;">
						<img src="img/kkm/shtrih_light_f.jpg" height="150">
					</div>
					<div>
						<p>ККТ ШТРИХ-ЛАЙТ-01Ф</p>
						Недорогой фискальный регистратор с функцией передачи данных через интернет.<br>
						<p>30 500р.</p>
						<a class="btn btn-sm btn-primary" style="margin: 5px;" href="buy-kkt?model=shtrih-lite-01f">Купить ККТ</a>
					</div>
				</div>
				<div class="col-sx-12 col-sm-3 col-md-3 col-lg-3" >
					<div  style="height: 150px;">
						<img src="img/kkm/shtrih_online.jpg" height="150">
					</div>
					<div>
						<p>ККТ ШТРИХ-ON-LINE</p>
						Отличается эргономичным дизайном, малыми габаритами и привлекательной ценой.<br>
						<p>21 000р.</p>
						<a class="btn btn-sm btn-primary" style="margin: 5px;" href="buy-kkt?model=shtrih-online">Купить ККТ</a>
					</div>
				</div>				
				<div class="col-sx-12 col-sm-3 col-md-3 col-lg-3" >
					<div  style="height: 150px;">
						<img src="img/kkm/mpay_f_01.jpg" height="150">
					</div>
					<div>
						<p>ККТ ШТРИХ-MPAY-Ф</p>
						Применяется в обязательном порядке для ИП и ООО для наличных расчетов и расчетов с платежных карт.<br>
						<p>28 000р.</p>
						<a class="btn btn-sm btn-primary" style="margin: 5px;" href="buy-kkt?model=shtrih-mpay-f">Купить ККТ</a>
					</div>
				</div>				
			</div>
			<br>
			<div class="row" >
				<div class="col-sx-12 col-sm-3 col-md-3 col-lg-3" >
					<div style="height: 150px;">
						<img src="img/kkm/merk115.jpg" height="150">
					</div>
					<div>
						<p>Меркурий-115Ф</p>
						Онлайн касса 2017 года, новое поколение переносных кассовых аппаратов завода Инкотекс<br>
						<p>20 000р.</p>
						<a class="btn btn-sm btn-primary" style="margin: 5px;" href="buy-kkt?model=merkury-115f">Купить ККТ</a>
					</div>
				</div>
				<div class="col-sx-12 col-sm-3 col-md-3 col-lg-3" >
					<div  style="height: 150px;">
						<img src="img/kkm/merk119.jpg" height="150">
					</div>
					<div>
						<p>Меркурий-119Ф</p>
						ККТ нового поколения с ФН и онлайн передачей данных в ФНС.<br>
						<p>30 000р.</p>
						<a class="btn btn-sm btn-primary" style="margin: 5px;" href="buy-kkt?model=merkury-119f">Купить ККТ</a>
					</div>
				</div>
				<div class="col-sx-12 col-sm-3 col-md-3 col-lg-3" >
					<div  style="height: 150px;">
						<img src="img/kkm/merk185.jpg" height="150">
					</div>
					<div>
						<p>Меркурий-185Ф</p>
						ККТ нового поколения с ФН и онлайн передачей данных в ФНС.<br>
						<p>20 000р.</p>
						<a class="btn btn-sm btn-primary" style="margin: 5px;" href="buy-kkt?model=merkury-185f">Купить ККТ</a>
					</div>
				</div>				
			</div>			
		</div>
		<br>
		<p>У нас вы можете купить кассовый аппарат с передачей данных онлайн для ИП, ООО и других видов организационных форм.</p>
			<p>На сайте представлено лишь несколько наименований продукции. 
Для того, чтобы подобрать наиболее подходящее решение и купить ККТ недорого, вы можете скачать полный каталог или обратиться за консультацией к специалисту.</p>
    </div>

    <div class="body-content">
        <?php /*
<!--
        <div class="row">
            <div class="col-lg-4">

                <h2>Heading</h2>

                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et
                    dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip
                    ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu
                    fugiat nulla pariatur.</p>

                <p><a class="btn btn-default" href="http://www.yiiframework.com/doc/">Yii Documentation &raquo;</a></p>
            </div>
            <div class="col-lg-4">
                <h2>Heading</h2>

                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et
                    dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip
                    ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu
                    fugiat nulla pariatur.</p>

                <p><a class="btn btn-default" href="http://www.yiiframework.com/forum/">Yii Forum &raquo;</a></p>
            </div>
            <div class="col-lg-4">
                <h2>Heading</h2>

                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et
                    dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip
                    ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu
                    fugiat nulla pariatur.</p>

                <p><a class="btn btn-default" href="http://www.yiiframework.com/extensions/">Yii Extensions &raquo;</a></p>
            </div>
        </div>
--> */
        ?>
    </div>
</div>
