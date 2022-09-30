<?php if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

use \Bitrix\Main\Localization\Loc;
?>
<main>
    <div class="row">
        <h4 class="mb-3"><?=Loc::getMessage("TITLE_FORM")?></h4>
        <?php if(count($arResult['ERROR'])): ?>
            <div class="alert alert-danger" role="alert">
                <ul>
            <?php foreach ($arResult['ERROR'] as $error): ?>
                <li><?=$error?></li>
            <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>
        <?php if($arResult['SEND'] == 'OK'): ?>
            <div class="alert alert-success" role="alert">
                <?=Loc::getMessage("SUCCESS")?>
            </div>
        <?php endif; ?>
        <form class="needs-validation" novalidate="" method="post" enctype="multipart/form-data">
            <div class="row g-3">
                <div class="col-12">
                    <label for="titleForm" class="form-label"><?=Loc::getMessage("FIELD_TITLE")?></label>
                    <input type="text" class="form-control" id="titleForm" name="FORM[TITLE]" placeholder="" required="" value="" >
                    <div class="invalid-feedback">
                        <?=Loc::getMessage("THIS_REQUIRED_FIELD")?>
                    </div>
                </div>
                <h4 class="mb-0"><?=Loc::getMessage("FIELD_CATEGORY")?></h4>

                <div class="my-3">
                    <?php foreach ($arParams['CATEGORY_FIELD'] as $key => $category):?>
                    <div class="form-check">
                        <input id="category-<?=$key?>" name="FORM[CATEGORY]" type="radio" class="form-check-input" required="" value="<?=$key?>">
                        <label class="form-check-label" for="category-<?=$key?>"><?=$category?></label>
                    </div>
                    <?php endforeach; ?>
                </div>

                <h4 class="mb-0"><?=Loc::getMessage("FIELD_VIEW")?></h4>

                <div class="my-3">
                    <?php foreach ($arParams['VIEW_FIELD'] as $key => $view):?>
                        <div class="form-check">
                            <input id="view-<?=$key?>" name="FORM[VIEW]" type="radio" class="form-check-input" required="" value="<?=$key?>">
                            <label class="form-check-label" for="view-<?=$key?>"><?=$view?></label>
                        </div>
                    <?php endforeach; ?>
                </div>

                <div>
                    <label for="stock_to" class="form-label h4"><?=Loc::getMessage("FIELD_STOCK")?></label>
                    <select class="form-select" name="FORM[STOCK]" id="stock_to" required="">
                        <option selected><?=Loc::getMessage("FIELD_STOCK_EMPTY")?></option>
                        <?php foreach ($arParams['STOCK_FIELD'] as $key => $stock):?>
                        <option value="<?=$key?>"><?=$stock?></option>
                        <?php endforeach; ?>
                    </select>
                    <div class="invalid-feedback">
                        <?=Loc::getMessage("THIS_REQUIRED_FIELD")?>
                    </div>
                </div>

                <h4 class="mb-0"><?=Loc::getMessage("FIELD_MAKE")?></h4>
                <div class="list-make">
                    <div class="input-group mb-2 make-item">
                        <label class="input-group-text"><?=Loc::getMessage("FIELD_BRAND")?></label>
                        <select class="form-select" name="FORM[MAKE][BRAND][]">
                            <option selected><?=Loc::getMessage("FIELD_BRAND_EMPTY")?></option>
                            <?php foreach ($arParams['BRAND_FIELD'] as $key => $brand):?>
                            <option value="<?=$key?>"><?=$brand?></option>
                            <?php endforeach; ?>
                        </select>
                        <?php foreach ($arParams['MAKE_FIELD'] as $key => $makeField):?>
                        <label class="input-group-text"><?=$makeField?></label>
                        <input type="text" class="form-control" name="FORM[MAKE][ADDON_FIELD_<?=$key?>][]">
                        <?php endforeach; ?>
                        <label class="input-group-text"><a href="#" class="bi bi-x-lg del-item"></a></label>
                    </div>
                </div>
                <div class="d-grid gap-2 d-md-block">
                    <button type="button" class="btn btn-secondary text-nowrap add-make-list"><i class="bi bi-plus-square-fill"></i> <?=Loc::getMessage("ADD_FIELD_MAKE")?></button>
                </div>

                <div class="mb-3">
                    <label for="formFile" class="form-label"><?=Loc::getMessage("FILE_FORM")?></label>
                    <input class="form-control" type="file" name="FILE_FORM" id="formFile">
                </div>

                <div class="mb-3">
                    <label for="exampleFormControlTextarea1" class="form-label"><?=Loc::getMessage("FIELD_COMMENT")?></label>
                    <textarea class="form-control" id="exampleFormControlTextarea1" name="FORM[COMMENT]" rows="3"></textarea>
                </div>

            </div>

            <button class="btn btn-primary" type="submit"><?=Loc::getMessage("SUBMIT")?></button>
        </form>
    </div>
</main>