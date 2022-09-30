<?

use Bitrix\Main;
use Bitrix\Main\Localization\Loc as Loc;
use Bitrix\Main\Application;
use Bitrix\Main\Mail\Event;
use Bitrix\Main\Web\Uri;

class FormRusoilComponent extends \CBitrixComponent
{
    private $dataForm;
    private $fileForm;
    protected $returned;

    public function onIncludeComponentLang()
    {
        $this->includeComponentLang(basename(__FILE__));
        Loc::loadMessages(__FILE__);
    }

    protected function checkParams()
    {
        if (empty($this->arParams['EMAIL_TO']) || !check_email($this->arParams['EMAIL_TO']))
            throw new Main\ArgumentNullException('EMAIL_TO');
    }

    public function onPrepareComponentParams($params)
    {
        $result = [
            'EMAIL_TO' => trim($params['EMAIL_TO']),
            'AJAX' => $params['AJAX'] == 'N' ? 'N' : $_REQUEST['AJAX'] == 'Y' ? 'Y' : 'N',
        ];

        $categoryField = [];
        foreach ($params['CATEGORY_FIELD'] as $val) {
            if(!empty($val)) $categoryField[] = $val;
        }
        if(count($categoryField)) {
            $result['CATEGORY_FIELD'] = $categoryField;
        } else {
            $result['CATEGORY_FIELD'] = [
                Loc::getMessage("CATEGORY_DEFAULT_VALUE_1"),
                Loc::getMessage("CATEGORY_DEFAULT_VALUE_2"),
            ];
        }

        $viewField = [];
        foreach ($params['VIEW_FIELD'] as $val) {
            if(!empty($val)) $viewField[] = $val;
        }
        if(count($viewField)) {
            $result['VIEW_FIELD'] = $viewField;
        } else {
            $result['VIEW_FIELD'] = [
                Loc::getMessage("VIEW_DEFAULT_VALUE_1"),
                Loc::getMessage("VIEW_DEFAULT_VALUE_2"),
                Loc::getMessage("VIEW_DEFAULT_VALUE_3"),
            ];
        }

        $stockField = [];
        foreach ($params['STOCK_FIELD'] as $val) {
            if(!empty($val)) $stockField[] = $val;
        }
        if(count($stockField)) {
            $result['STOCK_FIELD'] = $stockField;
        } else {
            $result['STOCK_FIELD'] = [
                Loc::getMessage("STOCK_DEFAULT_VALUE_1"),
                Loc::getMessage("STOCK_DEFAULT_VALUE_2"),
                Loc::getMessage("STOCK_DEFAULT_VALUE_3"),
            ];
        }

        $brandField = [];
        foreach ($params['BRAND_FIELD'] as $val) {
            if(!empty($val)) $brandField[] = $val;
        }
        if(count($brandField)) {
            $result['BRAND_FIELD'] = $brandField;
        } else {
            $result['BRAND_FIELD'] = [
                Loc::getMessage("BRAND_DEFAULT_VALUE_1"),
                Loc::getMessage("BRAND_DEFAULT_VALUE_2"),
                Loc::getMessage("BRAND_DEFAULT_VALUE_3"),
            ];
        }

        $makeField = [];
        foreach ($params['MAKE_FIELD'] as $val) {
            if(!empty($val)) $makeField[] = $val;
        }
        if(count($makeField)) {
            $result['MAKE_FIELD'] = $makeField;
        } else {
            $result['MAKE_FIELD'] = [
                Loc::getMessage("MAKE_DEFAULT_VALUE_NAME"),
                Loc::getMessage("MAKE_DEFAULT_VALUE_COUNT"),
                Loc::getMessage("MAKE_DEFAULT_VALUE_PACK"),
                Loc::getMessage("MAKE_DEFAULT_VALUE_CLIENT"),
            ];
        }

        return $result;
    }

    private function getResult()
    {
        $request = Application::getInstance()->getContext()->getRequest();
        $this->dataForm = $request->getPost('FORM');
        $this->fileForm = $request->getFile('FILE_FORM');
        if($request->getQuery('success') == 'ok') $this->arResult['SEND'] = 'OK';
    }

    private function checkData()
    {
        if(!empty($this->dataForm) && is_array($this->dataForm)) {
            if (!isset($this->dataForm['TITLE']) || empty($this->dataForm['TITLE'])) {
                $this->arResult['ERROR'][] = Loc::getMessage("FIELD_TITLE").': '.Loc::getMessage("REQUIRED_FIELD");
            }
            if (!isset($this->dataForm['CATEGORY']) || !is_numeric($this->dataForm['CATEGORY'])) {
                $this->arResult['ERROR'][] = Loc::getMessage("FIELD_CATEGORY").': '.Loc::getMessage("REQUIRED_FIELD");
            }
            if (!isset($this->dataForm['VIEW']) || !is_numeric($this->dataForm['VIEW'])) {
                $this->arResult['ERROR'][] = Loc::getMessage("FIELD_VIEW").': '.Loc::getMessage("REQUIRED_FIELD");
            }
            return count($this->arResult['ERROR'])>0?false:true;
        }
        return false;
    }

    private function makeTextEmail()
    {
        $text = Loc::getMessage("FIELD_TITLE").': '.$this->dataForm['TITLE']."\n\n";
        $text .= Loc::getMessage("FIELD_CATEGORY").': '.$this->arParams['CATEGORY_FIELD'][$this->dataForm['CATEGORY']]."\n\n";
        $text .= Loc::getMessage("FIELD_VIEW").': '.$this->arParams['VIEW_FIELD'][$this->dataForm['VIEW']]."\n\n";
        $text .= Loc::getMessage("FIELD_STOCK").': '.((isset($this->arParams['STOCK_FIELD'][$this->dataForm['STOCK']]))?$this->arParams['STOCK_FIELD'][$this->dataForm['STOCK']]:'-')."\n\n";

        $makeArray = [];
        $n = 0;
        foreach ($this->dataForm['MAKE']['BRAND'] as $cnt => $brand) {
            if(is_numeric($brand) && isset($this->arParams['BRAND_FIELD'][$brand])) {
                $n++;
                $make = $n.') '.Loc::getMessage("FIELD_BRAND").': '.$this->arParams['BRAND_FIELD'][$brand].' | ';
                $addonFields = [];
                foreach ($this->arParams['MAKE_FIELD'] as $key => $field) {
                    $addonFields[] = $field.': '.$this->dataForm['MAKE']['ADDON_FIELD_'.$key][$cnt];
                }
                $make .= implode(' | ', $addonFields);
                $makeArray[] = $make;
            }
        }

        if(count($makeArray)) {
            $text .= Loc::getMessage("FIELD_MAKE").": \n".implode("\n",$makeArray)."\n\n";
        }

        $text .= Loc::getMessage("FIELD_COMMENT").': '.(!empty($this->dataForm['COMMENT'])?$this->dataForm['COMMENT']:' - ')."\n";

        $fileId = false;
        if($this->fileForm['error'] == 0) {
            $text .= "\n".Loc::getMessage("ADD_FILE");
            $fileId = \CFile::SaveFile($this->fileForm,'mailatt');
        }

        $eventData = [
            "EVENT_NAME" => "FORM_RUSOIL",
            "LID" => SITE_ID,
            "C_FIELDS" => array(
                "EMAIL" => $this->arParams['EMAIL_TO'],
                "MESSAGE" => $text
            ),
        ];
        if($fileId) $eventData['FILE'] = [$fileId];
        Event::send($eventData);
        if($fileId) \CFile::Delete($fileId);
    }

    protected function sendForm()
    {
        if($this->checkData()) {
            $this->makeTextEmail();

            $request = Application::getInstance()->getContext()->getRequest();
            $uriString = $request->getRequestUri();
            $uri = new Uri($uriString);
            $uri->deleteParams(['success']);
            $uri->addParams(array('success' => 'ok'));
            $redirect = $uri->getUri();
            LocalRedirect($redirect);
        }
    }

    public function executeComponent()
    {
        try {
            $this->checkParams();

            $this->getResult();
            $this->sendForm();
            $this->includeComponentTemplate();

            return $this->returned;
        } catch (Exception $e) {
            ShowError($e->getMessage());
        }
    }
}