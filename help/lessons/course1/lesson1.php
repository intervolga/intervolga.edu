<?php
B_PROLOG_INCLUDED === true || die();
global $USER;
?>
<ol>
	<li>
		Не забудьте обновить Битрикс до последней версии. Обычно сразу после установки кнопка установки обновлений недоступна &mdash; чтобы она появилась, нужно принять лицензионное соглашение
		<br>
		<img src="<?= IV_EDU_MODULE_DIR ?>/help/images/course1lesson1update.png" alt="">
	</li>
	<li>В комментариях к тикету в YouTrack по этому уроку оставьте адрес вашего сайта (<b>https://<?=$_SERVER['SERVER_NAME']?></b>), логин (<b><?=$USER->getLogin()?></b>) и пароль</li>
</ol>