<?php B_PROLOG_INCLUDED === true || die();

use Bitrix\Main\Localization\Loc;
use Bitrix\Main\Page\Asset;
use Intervolga\Edu\Util\StandardsHelper;

global $APPLICATION;

\CJSCore::init(['jquery']);
Asset::getInstance()->addJs(IV_EDU_MODULE_DIR . '/lib/checker/checker.js');
$APPLICATION->setAdditionalCSS(IV_EDU_MODULE_DIR . '/lib/checker/style.css');
$standardsList = StandardsHelper::getStandardsList();

?>
	<table>
	<tbody>
<tr id="intervolga-checker">
	<td valign="top" width="50%" align="center" id="input-block">
		<form action="#" method="post">
			<p><b class="title"><?=Loc::getMessage('INTERVOLGA_EDU.CHECKER_TITLE')?></b></p>
			<div id="radio">
				<div><input type="radio" name="content_type" value="code" checked/> Фрагмент кода <br></div>
				<div><input type="radio" name="content_type" value="file" /> Путь к файлу <br></div>
				<div><input type="radio" name="content_type" value="folder" /> Путь к папке <br></div>
			</div>
			<p><textarea rows="10" cols="80" name="code" placeholder="Введите свой код"></textarea></p>
			<ul>
				<div class="title"><?=Loc::getMessage('INTERVOLGA_EDU.CHECKER_TITLE_STANDARDS')?></div>
				<? if ($standardsList):
					foreach ($standardsList as $standard):?>
						<li>
							<div>
								<input type="checkbox" name="standards" id="<?=$standard?>" value="<?=$standard?>">
								<label for="<?=$standard?>"><?=Loc::getMessage('INTERVOLGA_EDU.CHECKER_' . $standard)?></label>
							</div>
						</li>
					<?endforeach;
				endif; ?>
			</ul>
			<p><input type="button" id="sendbutton" value="Отправить"></p>

		</form>
	</td>
	<td valign="top" width="40%" class="adm-detail-content-cell-r">
		<div id="result"><?=Loc::getMessage('INTERVOLGA_EDU.CHECKER_RESULTS')?></div>
	</td>
</tr>
<?php
