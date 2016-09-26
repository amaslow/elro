<?php

App::uses('Folder', 'Utility');

class ItemsController extends AppController {

    public $helpers = array('Html', 'Form');
    public $paginate = array(
        'order' => array('Item.ITEM' => 'asc'),
        'maxLimit' => ''
    );

    public function flash($message, $class = 'status') {
        $old = $this->Session->read('messages');
        $old[$class][] = $message;
        $this->Session->write('messages', $old);
    }

    public function index() {
        $item_ch = (isset($this->request->query['filter']) ? $this->request->query['filter'] : 'ARTURO');
        $item_ch_1 = substr($item_ch, 0, 2) . "." . substr($item_ch, 2, 3) . "." . substr($item_ch, 5, 2);

        if (empty($this->request->query['filter'])) {
            $item_ch = 'ARTURO';
        }
        if ($this->Session->read('Auth.User')) {
            $filterQuene = "Item.ITEM like '%{$item_ch}%' OR Item.SAP like '%{$item_ch}%' OR Item.SAP like '%{$item_ch_1}%' OR Item.DESCR_EN like '%{$item_ch}%' OR Item.EAN like '%{$item_ch}%' OR Item.EAN_INN like '%{$item_ch}%' OR Item.EAN_OUT like '%{$item_ch}%' OR Item.BRAND like '%{$item_ch}%' "
                    . "OR Item.VENDOR like '%{$item_ch}%' OR Item.SUPPLIER like '%{$item_ch}%' OR Item.ITEM_S like '%{$item_ch}%' OR Item.ITEM_S_SAP like '%{$item_ch}%' ";
        } else {
            $filterQuene = "Item.ITEM like '%{$item_ch}%' OR Item.SAP like '%{$item_ch}%' OR Item.SAP like '%{$item_ch_1}%' OR Item.DESCR_EN like '%{$item_ch}%' OR Item.EAN like '%{$item_ch}%' OR Item.EAN_INN like '%{$item_ch}%' OR Item.EAN_OUT like '%{$item_ch}%' OR Item.BRAND like '%{$item_ch}%' ";
        }
        $this->set('items', $this->paginate('Item', array($filterQuene)));
    }

    public function view($id = null) {

        if (!$id) {
            throw new NotFoundException(__('Product does not exist'));
        }
        $item = $this->Item->findById($id);
        if (!$item) {
            throw new NotFoundException(__('Product does not exist'));
        }
        $this->set('item', $item);
        if (!$this->request->data) {
            $this->request->data = $item;
        }

        $this->loadModel('Supplier');
        $this->set('item_vendor', $this->Supplier->findByOfficeVendorOrOfficeVendorSfeOrFactory1VendorOrFactory2VendorOrFactory3Vendor($item['Item']['VENDOR'],$item['Item']['VENDOR'],$item['Item']['VENDOR'],$item['Item']['VENDOR'],$item['Item']['VENDOR'], array('Supplier.ID')));
        if ($item['Item']['ITEM_S'] != '') {
            $this->set('item_supplier', $this->Item->findAllByItemS($item['Item']['ITEM_S'], array('Item.ID', 'Item.QM_STATUS', 'Item.SAP', 'Item.ITEM', 'Item.DESCR_EN', 'Item.EAN', 'Item.BRAND', 'Item.STATUS', 'Item.VALID_DATE')));
        }
        if (!empty($item['Item']['COMPONENT1'])) {
            for ($i = 1; $i < 11; $i++) {
                $sapek = strstr($item['Item']['COMPONENT' . $i] . ' ', ' ', true);
//                !empty($item['Item']['COMPONENT'.$i]) ? $this->set('item_comp'.$i, $this->Item->findBySap(substr($item['Item']['COMPONENT'.$i],0,9),array('Item.ID','Item.SAP','Item.QM_STATUS','Item.STATUS'))) : false;
                !empty($item['Item']['COMPONENT' . $i]) ? $this->set('item_comp' . $i, $this->Item->findBySap($sapek, array('Item.ID', 'Item.SAP', 'Item.QM_STATUS', 'Item.STATUS'))) : false;
            }
        }
        $this->loadModel('Standardr');
        for ($r = 1; $r < 5; $r++) {
            if (strlen($item['Item']['RF' . $r]) > 0) {
                $rf_st = explode(":", $item['Item']['RF' . $r]);
                if (strlen($rf_st[0]) > 8) {
//                    $this->set('rf_standard'.$r, $this->Standardr->findByRfOld($rf_st[0],array('Standardr.RF_DATE_FROM')));
                    $this->set('rf_standard' . $r, $this->Standardr->findByRfOld($rf_st[0], array('Standardr.RF_DATE_FROM', 'Standardr.RF_DATE_TILL', 'Standardr.RF_NEW', 'Standardr.RF_DESCR')));
                } else {
                    $this->set('rf_standard' . $r, $this->Standardr->findByRfOld($item['Item']['RF' . $r], array('Standardr.RF_DATE_FROM', 'Standardr.RF_DATE_TILL', 'Standardr.RF_NEW', 'Standardr.RF_DESCR')));
                }
            }
            if (strlen($item['Item']['CPD' . $r]) > 0) {
                $this->set('cpd_standard' . $r, $this->Standardr->findByRfOld($item['Item']['CPD' . $r], array('Standardr.RF_DATE_FROM', 'Standardr.RF_DATE_TILL', 'Standardr.RF_NEW', 'Standardr.RF_DESCR')));
            }
        }
    }

    public function add() {
        if ($this->request->is('post')) {
            $this->Item->create();
            if ($this->Item->save($this->request->data)) {
                $this->Session->setFlash('Product has been saved');
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash('Saving product error');
            }
        }
    }

    public function search() {
        $item_ch = (isset($this->request->query['filters']) ? $this->request->query['filters'] : 'ARTURO');
        if (empty($this->request->query['filters'])) {
            $item_ch = 'ARTURO';
        }
        $filterQuene = "Item.LVD1 like '%{$item_ch}%' OR Item.LVD2 like '%{$item_ch}%' OR Item.LVD3 like '%{$item_ch}%' OR Item.LVD4 like '%{$item_ch}%' OR Item.LVD5 like '%{$item_ch}%' "
        . "OR Item.LVD6 like '%{$item_ch}%' OR Item.LVD7 like '%{$item_ch}%' OR Item.LVD8 like '%{$item_ch}%' OR Item.LVD9 like '%{$item_ch}%'"
        . "OR Item.EMC1 like '%{$item_ch}%' OR Item.EMC2 like '%{$item_ch}%' OR Item.EMC3 like '%{$item_ch}%' OR Item.EMC4 like '%{$item_ch}%' OR Item.EMC5 like '%{$item_ch}%' "
        . "OR Item.EMC6 like '%{$item_ch}%' OR Item.EMC7 like '%{$item_ch}%' OR Item.EMC8 like '%{$item_ch}%' OR Item.EMC9 like '%{$item_ch}%' OR Item.EMC10 like '%{$item_ch}%' "
        . "OR Item.CPD1 like '%{$item_ch}%' OR Item.CPD2 like '%{$item_ch}%' OR Item.CPD3 like '%{$item_ch}%' OR Item.CPD4 like '%{$item_ch}%' "
        . "OR Item.RF1 like '%{$item_ch}%' OR Item.RF2 like '%{$item_ch}%' OR Item.RF3 like '%{$item_ch}%' OR Item.RF4 like '%{$item_ch}%' ";
        $this->set('items', $this->paginate('Item', array($filterQuene)));
    }

    public function edit($id = null) {
        if (!$id) {
            throw new NotFoundException(__('Product does not exist'));
        }
        $item = $this->Item->findById($id);
        if (!$item) {
            throw new NotFoundException(__('Product does not exist'));
        }
        if (!empty($item['Item']['COMPONENT1'])) {
            for ($i = 1; $i < 11; $i++) {
                $sapek = strstr($item['Item']['COMPONENT' . $i] . ' ', ' ', true);
                //!empty($item['Item']['COMPONENT' . $i]) ? $this->set('item_comp' . $i, $this->Item->findBySap(substr($item['Item']['COMPONENT' . $i], 0, 9), array('Item.QM_STATUS'))) : false;
                !empty($item['Item']['COMPONENT' . $i]) ? $this->set('item_comp' . $i, $this->Item->findBySap($sapek, array('Item.QM_STATUS'))) : false;
            }
        }
        if ($this->request->is('post') || $this->request->is('put')) {
            $this->Item->id = $id;
            if ($this->Item->save($this->request->data)) {
                if ($this->Auth->user('id') != 1) {
                    $this->Item->saveField('MOD_WHO', $this->Auth->user('username'));
                    $this->Item->saveField('MOD_DATE', date('Y-m-d'));
                }
                if ($this->Item->field('COMPONENT1') == null) {
                    if (strpos($this->Item->field('LVD_TR'), 'MISSING') !== false || strpos($this->Item->field('EMC_TR'), 'MISSING') !== false || strpos($this->Item->field('RF_TR'), 'MISSING') !== false || strpos($this->Item->field('CPD_CE'), 'MISSING') !== false || strpos($this->Item->field('EUP_TR'), 'MISSING') !== false) {
                        $this->Item->saveField('QM_STATUS', 'RED');
                    } elseif (strpos($this->Item->field('LVD_TR'), 'MISSING') === false && strpos($this->Item->field('EMC_TR'), 'MISSING') === false && strpos($this->Item->field('RF_TR'), 'MISSING') === false && strpos($this->Item->field('CPD_CE'), 'MISSING') === false && strpos($this->Item->field('EUP_TR'), 'MISSING') === false && strpos($this->Item->field('ROHS_TR'), 'MISSING') === false && strpos($this->Item->field('PHOTOBIOL_TR'), 'MISSING') === false && strpos($this->Item->field('IPCLASS_TR'), 'MISSING') === false && strpos($this->Item->field('EUP_STATUS'), '1000h') === false && strpos($this->Item->field('REACH_CE'), 'MISSING') === false && strpos($this->Item->field('BATT_M'), 'MISSING') === false && strpos($this->Item->field('BATT_TR2'), 'MISSING') === false) {
                        $this->Item->saveField('QM_STATUS', 'GREEN');
                    } else {
                        $this->Item->saveField('QM_STATUS', 'ORANGE');
                    }
                    if ($this->Item->field('ADAPTOR1') == 1) {
                        if (strpos($this->Item->field('ADAPTOR1_LVD'), 'MISSING') !== false || strpos($this->Item->field('ADAPTOR1_EMC'), 'MISSING') !== false || strpos($this->Item->field('ADAPTOR1_ERP'), 'MISSING') !== false) {
                            $this->Item->saveField('QC_STATUS', 'RED');
                        } elseif (strpos($this->Item->field('ADAPTOR1_LVD'), 'MISSING') === false && strpos($this->Item->field('ADAPTOR1_EMC'), 'MISSING') === false && strpos($this->Item->field('ADAPTOR1_ERP'), 'MISSING') === false && strpos($this->Item->field('ADAPTOR1_RoHS'), 'MISSING') !== false) {
                            $this->Item->saveField('QC_STATUS', 'ORANGE');
                        } else {
                            $this->Item->saveField('QC_STATUS', 'GREEN');
                        }
                    } else {
                        $this->Item->saveField('QC_STATUS', null);
                    }
                }
                $this->Session->setFlash('Product has been modified ', 'default', array('class' => 'success'));
                $this->redirect(array('action' => 'view/' . $id));
            } else {
                $this->Session->setFlash('Editing product error');
            }
        }
        $this->set('item', $item);
        if (!$this->request->data) {
            $this->request->data = $item;
        }
    }

    public function copyCert($id) {
        $item = $this->Item->findById($id);
        if ($this->request->is('post') || $this->request->is('put')) {
            $this->Item->id = $id;
            $this->Item->updateAll(
                    array(
                'QM_STATUS' => ("'" . $item['Item']['QM_STATUS'] . "'"),
                'EMC1' => ("'" . $item['Item']['EMC1'] . "'"),
                'EMC2' => (isset($item['Item']['EMC2']) ? "'" . $item['Item']['EMC2'] . "'" : null),
                'EMC3' => (isset($item['Item']['EMC3']) ? "'" . $item['Item']['EMC3'] . "'" : null),
                'EMC4' => (isset($item['Item']['EMC4']) ? "'" . $item['Item']['EMC4'] . "'" : null),
                'EMC5' => (isset($item['Item']['EMC5']) ? "'" . $item['Item']['EMC5'] . "'" : null),
                'EMC6' => (isset($item['Item']['EMC6']) ? "'" . $item['Item']['EMC6'] . "'" : null),
                'EMC7' => (isset($item['Item']['EMC7']) ? "'" . $item['Item']['EMC7'] . "'" : null),
                'EMC8' => (isset($item['Item']['EMC8']) ? "'" . $item['Item']['EMC8'] . "'" : null),
                'EMC9' => (isset($item['Item']['EMC9']) ? "'" . $item['Item']['EMC9'] . "'" : null),
                'EMC10' => (isset($item['Item']['EMC10']) ? "'" . $item['Item']['EMC10'] . "'" : null),
                'LVD1' => (isset($item['Item']['LVD1']) ? "'" . $item['Item']['LVD1'] . "'" : null),
                'LVD2' => (isset($item['Item']['LVD2']) ? "'" . $item['Item']['LVD2'] . "'" : null),
                'LVD3' => (isset($item['Item']['LVD3']) ? "'" . $item['Item']['LVD3'] . "'" : null),
                'LVD4' => (isset($item['Item']['LVD4']) ? "'" . $item['Item']['LVD4'] . "'" : null),
                'LVD5' => (isset($item['Item']['LVD5']) ? "'" . $item['Item']['LVD5'] . "'" : null),
                'LVD6' => (isset($item['Item']['LVD6']) ? "'" . $item['Item']['LVD6'] . "'" : null),
                'LVD7' => (isset($item['Item']['LVD7']) ? "'" . $item['Item']['LVD7'] . "'" : null),
                'LVD8' => (isset($item['Item']['LVD8']) ? "'" . $item['Item']['LVD8'] . "'" : null),
                'LVD9' => (isset($item['Item']['LVD9']) ? "'" . $item['Item']['LVD9'] . "'" : null),
                'CPD1' => (isset($item['Item']['CPD1']) ? "'" . $item['Item']['CPD1'] . "'" : null),
                'CPD2' => (isset($item['Item']['CPD2']) ? "'" . $item['Item']['CPD2'] . "'" : null),
                'CPD3' => (isset($item['Item']['CPD3']) ? "'" . $item['Item']['CPD3'] . "'" : null),
                'CPD4' => (isset($item['Item']['CPD4']) ? "'" . $item['Item']['CPD4'] . "'" : null),
                'RF1' => (isset($item['Item']['RF1']) ? "'" . $item['Item']['RF1'] . "'" : null),
                'RF2' => (isset($item['Item']['RF2']) ? "'" . $item['Item']['RF2'] . "'" : null),
                'RF3' => (isset($item['Item']['RF3']) ? "'" . $item['Item']['RF3'] . "'" : null),
                'RF4' => (isset($item['Item']['RF4']) ? "'" . $item['Item']['RF4'] . "'" : null),
                'GS' => ($item['Item']['GS'] == 0 ? 0 : 1),
                'GS_CE' => (isset($item['Item']['GS_CE']) ? "'" . $item['Item']['GS_CE'] . "'" : null),
                'GS_TR' => (isset($item['Item']['GS_TR']) ? "'" . $item['Item']['GS_TR'] . "'" : null),
                'GS_DATE' => (isset($item['Item']['GS_DATE']) ? "'" . $item['Item']['GS_DATE'] . "'" : null),
                'GS_NB' => (isset($item['Item']['GS_NB']) ? "'" . $item['Item']['GS_NB'] . "'" : null),
                'LVD' => ($item['Item']['LVD'] == 0 ? 0 : 1),
                'LVD_CE' => (isset($item['Item']['LVD_CE']) ? "'" . $item['Item']['LVD_CE'] . "'" : null),
                'LVD_CERT' => (isset($item['Item']['LVD_CERT']) ? "'" . $item['Item']['LVD_CERT'] . "'" : null),
                'LVD_TR' => (isset($item['Item']['LVD_TR']) ? "'" . $item['Item']['LVD_TR'] . "'" : null),
                'LVD_DATE' => (isset($item['Item']['LVD_DATE']) ? "'" . $item['Item']['LVD_DATE'] . "'" : null),
                'LVD_NB' => (isset($item['Item']['LVD_NB']) ? "'" . $item['Item']['LVD_NB'] . "'" : null),
                'PHOTOBIOL' => ($item['Item']['PHOTOBIOL'] == 0 ? 0 : 1),
                'PHOTOBIOL_TR' => (isset($item['Item']['PHOTOBIOL_TR']) ? "'" . $item['Item']['PHOTOBIOL_TR'] . "'" : null),
                'IPCLASS' => ($item['Item']['IPCLASS'] == 0 ? 0 : 1),
                'IPCLASS_TR' => (isset($item['Item']['IPCLASS_TR']) ? "'" . $item['Item']['IPCLASS_TR'] . "'" : null),
                'IP_RATE1' => (isset($item['Item']['IP_RATE1']) ? "'" . $item['Item']['IP_RATE1'] . "'" : null),
                'IP_RATE2' => (isset($item['Item']['IP_RATE2']) ? "'" . $item['Item']['IP_RATE2'] . "'" : null),
                'EMC' => ($item['Item']['EMC'] == 0 ? 0 : 1),
                'EMC_CE' => (isset($item['Item']['EMC_CE']) ? "'" . $item['Item']['EMC_CE'] . "'" : null),
                'EMC_CERT' => (isset($item['Item']['EMC_CERT']) ? "'" . $item['Item']['EMC_CERT'] . "'" : null),
                'EMC_TR' => (isset($item['Item']['EMC_TR']) ? "'" . $item['Item']['EMC_TR'] . "'" : null),
                'EMC_DATE' => (isset($item['Item']['EMC_DATE']) ? "'" . $item['Item']['EMC_DATE'] . "'" : null),
                'EMC_NB' => (isset($item['Item']['EMC_NB']) ? "'" . $item['Item']['EMC_NB'] . "'" : null),
                'RF' => ($item['Item']['RF'] == 0 ? 0 : 1),
                'RF_CE' => (isset($item['Item']['RF_CE']) ? "'" . $item['Item']['RF_CE'] . "'" : null),
                'RF_CERT' => (isset($item['Item']['RF_CERT']) ? "'" . $item['Item']['RF_CERT'] . "'" : null),
                'RF_TR' => (isset($item['Item']['RF_TR']) ? "'" . $item['Item']['RF_TR'] . "'" : null),
                'RF_DATE' => (isset($item['Item']['RF_DATE']) ? "'" . $item['Item']['RF_DATE'] . "'" : null),
                'RF_NB' => (isset($item['Item']['RF_NB']) ? "'" . $item['Item']['RF_NB'] . "'" : null),
                'RF_F' => (isset($item['Item']['RF_F']) ? "'" . $item['Item']['RF_F'] . "'" : null),
                'RF_NBN' => (isset($item['Item']['RF_NBN']) ? "'" . $item['Item']['RF_NBN'] . "'" : null),
                'ROHS' => ($item['Item']['ROHS'] == 0 ? 0 : 1),
                'ROHS_CE' => (isset($item['Item']['ROHS_CE']) ? "'" . $item['Item']['ROHS_CE'] . "'" : null),
                'ROHS_CERT' => (isset($item['Item']['ROHS_CERT']) ? "'" . $item['Item']['ROHS_CERT'] . "'" : null),
                'ROHS_TR' => (isset($item['Item']['ROHS_TR']) ? "'" . $item['Item']['ROHS_TR'] . "'" : null),
                'ROHS_DATE' => (isset($item['Item']['ROHS_DATE']) ? "'" . $item['Item']['ROHS_DATE'] . "'" : null),
                'ROHS_NB' => (isset($item['Item']['ROHS_NB']) ? "'" . $item['Item']['ROHS_NB'] . "'" : null),
                'EUP' => ($item['Item']['EUP'] == 0 ? 0 : 1),
                'EUP_CE' => (isset($item['Item']['EUP_CE']) ? "'" . $item['Item']['EUP_CE'] . "'" : null),
                'EUP_TR' => (isset($item['Item']['EUP_TR']) ? "'" . $item['Item']['EUP_TR'] . "'" : null),
                'EUP_DATE' => (isset($item['Item']['EUP_DATE']) ? "'" . $item['Item']['EUP_DATE'] . "'" : null),
                'EUP_STATUS' => (isset($item['Item']['EUP_STATUS']) ? "'" . $item['Item']['EUP_STATUS'] . "'" : null),
                'FLUX' => ($item['Item']['FLUX'] == 0 ? 0 : 1),
                'FLUX_TR' => (isset($item['Item']['FLUX_TR']) ? "'" . $item['Item']['FLUX_TR'] . "'" : null),
                'ErP_DIR2' => (isset($item['Item']['ErP_DIR2']) ? "'" . $item['Item']['ErP_DIR2'] . "'" : null),
                'ErP_TR2' => (isset($item['Item']['ErP_TR2']) ? "'" . $item['Item']['ErP_TR2'] . "'" : null),
                'ErP_DATE2' => (isset($item['Item']['ErP_DATE2']) ? "'" . $item['Item']['ErP_DATE2'] . "'" : null),
                'ErP_STATUS2' => (isset($item['Item']['ErP_STATUS2']) ? "'" . $item['Item']['ErP_STATUS2'] . "'" : null),
                'ErP_DIR3' => (isset($item['Item']['ErP_DIR3']) ? "'" . $item['Item']['ErP_DIR3'] . "'" : null),
                'ErP_TR3' => (isset($item['Item']['ErP_TR3']) ? "'" . $item['Item']['ErP_TR3'] . "'" : null),
                'ErP_DATE3' => (isset($item['Item']['ErP_DATE3']) ? "'" . $item['Item']['ErP_DATE3'] . "'" : null),
                'ErP_STATUS3' => (isset($item['Item']['ErP_STATUS3']) ? "'" . $item['Item']['ErP_STATUS3'] . "'" : null),                        
                'KK' => ($item['Item']['KK'] == 0 ? 0 : 1),
                'KK_CE' => (isset($item['Item']['KK_CE']) ? "'" . $item['Item']['KK_CE'] . "'" : null),
                'KK_DATE' => (isset($item['Item']['KK_DATE']) ? "'" . $item['Item']['KK_DATE'] . "'" : null),
                'REACH' => ($item['Item']['REACH'] == 0 ? 0 : 1),
                'REACH_CE' => (isset($item['Item']['REACH_CE']) ? "'" . $item['Item']['REACH_CE'] . "'" : null),
                'PHTH' => ($item['Item']['PHTH'] == 0 ? 0 : 1),
                'PAH' => ($item['Item']['PAH'] == 0 ? 0 : 1),
                'PAH_CE' => (isset($item['Item']['PAH_CE']) ? "'" . $item['Item']['PAH_CE'] . "'" : null),
                'BATT' => ($item['Item']['BATT'] == 0 ? 0 : 1),
                'BATT_M' => (isset($item['Item']['BATT_M']) ? "'" . $item['Item']['BATT_M'] . "'" : null),
                'BATT_QUA1' => (isset($item['Item']['BATT_QUA1']) ? "'" . $item['Item']['BATT_QUA1'] . "'" : null),
                'BATT_BRAND1' => (isset($item['Item']['BATT_BRAND1']) ? "'" . $item['Item']['BATT_BRAND1'] . "'" : null),
                'BATT_TYPE1' => (isset($item['Item']['BATT_TYPE1']) ? "'" . $item['Item']['BATT_TYPE1'] . "'" : null),
                'BATT_SIZE1' => (isset($item['Item']['BATT_SIZE1']) ? "'" . $item['Item']['BATT_SIZE1'] . "'" : null),
                'BATT_VOLT1' => (isset($item['Item']['BATT_VOLT1']) ? "'" . $item['Item']['BATT_VOLT1'] . "'" : null),
                'BATT_ACCU1' => ($item['Item']['BATT_ACCU1'] == 0 ? 0 : 1),
                'BATT_CAP1' => (isset($item['Item']['BATT_CAP1']) ? "'" . $item['Item']['BATT_CAP1'] . "'" : null),
                'BATT_REPL1' => ($item['Item']['BATT_REPL1'] == 0 ? 0 : 1),
                'BATT2' => ($item['Item']['BATT2'] == 0 ? 0 : 1),
                'BATT_TR2' => (isset($item['Item']['BATT_TR2']) ? "'" . $item['Item']['BATT_TR2'] . "'" : null),
                'BATT_QUA2' => (isset($item['Item']['BATT_QUA2']) ? "'" . $item['Item']['BATT_QUA2'] . "'" : null),
                'BATT_BRAND2' => (isset($item['Item']['BATT_BRAND2']) ? "'" . $item['Item']['BATT_BRAND2'] . "'" : null),
                'BATT_TYPE2' => (isset($item['Item']['BATT_TYPE2']) ? "'" . $item['Item']['BATT_TYPE2'] . "'" : null),
                'BATT_SIZE2' => (isset($item['Item']['BATT_SIZE2']) ? "'" . $item['Item']['BATT_SIZE2'] . "'" : null),
                'BATT_VOLT2' => (isset($item['Item']['BATT_VOLT2']) ? "'" . $item['Item']['BATT_VOLT2'] . "'" : null),
                'BATT_ACCU2' => ($item['Item']['BATT_ACCU2'] == 0 ? 0 : 1),
                'BATT_CAP2' => (isset($item['Item']['BATT_CAP2']) ? "'" . $item['Item']['BATT_CAP2'] . "'" : null),
                'BATT_REPL2' => ($item['Item']['BATT_REPL2'] == 0 ? 0 : 1)
                    ), array('ITEM_S' => $this->Item->field('ITEM_S'))
            );
            $this->Session->setFlash('All certificates info has been copied', 'default', array('class' => 'success'));
            $this->redirect(array('action' => 'view/' . $id));
        }
    }

    public function copyERP($id) {
        $item = $this->Item->findById($id);
        if ($this->request->is('post') || $this->request->is('put')) {
            $this->Item->id = $id;
            $this->Item->updateAll(
                    array(
                'KIND_BULB' => (isset($item['Item']['KIND_BULB']) ? "'" . $item['Item']['KIND_BULB'] . "'" : null),
                'INCL' => ($item['Item']['INCL'] == 0 ? 0 : 1),
                'ITEM_BULB' => (isset($item['Item']['ITEM_BULB']) ? "'" . $item['Item']['ITEM_BULB'] . "'" : null),
                'INT_LED' => ($item['Item']['INT_LED'] == 0 ? 0 : 1),
                'SPECIAL_USE' => (isset($item['Item']['SPECIAL_USE']) ? "'" . $item['Item']['SPECIAL_USE'] . "'" : null),
                'COORDX' => (isset($item['Item']['COORDX']) ? "'" . $item['Item']['COORDX'] . "'" : null),
                'COORDY' => (isset($item['Item']['COORDY']) ? "'" . $item['Item']['COORDY'] . "'" : null),
                'WATTAGE' => (isset($item['Item']['WATTAGE']) ? "'" . $item['Item']['WATTAGE'] . "'" : null),
                'WATTAGE_RATED' => (isset($item['Item']['WATTAGE_RATED']) ? "'" . $item['Item']['WATTAGE_RATED'] . "'" : null),
                'LUMEN' => (isset($item['Item']['LUMEN']) ? "'" . $item['Item']['LUMEN'] . "'" : null),
                'LUMEN_RATED' => (isset($item['Item']['LUMEN_RATED']) ? "'" . $item['Item']['LUMEN_RATED'] . "'" : null),
                'LIFETIME' => (isset($item['Item']['LIFETIME']) ? "'" . $item['Item']['LIFETIME'] . "'" : null),
                'LIFETIME_RATED' => (isset($item['Item']['LIFETIME_RATED']) ? "'" . $item['Item']['LIFETIME_RATED'] . "'" : null),
                'SWICYC' => (isset($item['Item']['SWICYC']) ? "'" . $item['Item']['SWICYC'] . "'" : null),
                'KELVIN' => (isset($item['Item']['KELVIN']) ? "'" . $item['Item']['KELVIN'] . "'" : null),
                'RA' => (isset($item['Item']['RA']) ? "'" . $item['Item']['RA'] . "'" : null),
                'STAR60' => (isset($item['Item']['STAR60']) ? "'" . $item['Item']['STAR60'] . "'" : null),
                'START_TIME' => (isset($item['Item']['START_TIME']) ? "'" . $item['Item']['START_TIME'] . "'" : null),
                'COLOR_CONS' => (isset($item['Item']['COLOR_CONS']) ? "'" . $item['Item']['COLOR_CONS'] . "'" : null),
                'CANDELA' => (isset($item['Item']['CANDELA']) ? "'" . $item['Item']['CANDELA'] . "'" : null),
                'BEAM' => (isset($item['Item']['BEAM']) ? "'" . $item['Item']['BEAM'] . "'" : null),
                'ACCENT' => ($item['Item']['ACCENT'] == 0 ? 0 : 1),
                'DIMENSION_FI' => (isset($item['Item']['DIMENSION_FI']) ? "'" . $item['Item']['DIMENSION_FI'] . "'" : null),
                'DIMENSION_L' => (isset($item['Item']['DIMENSION_L']) ? "'" . $item['Item']['DIMENSION_L'] . "'" : null),
                'DIMENSION_D' => (isset($item['Item']['DIMENSION_D']) ? "'" . $item['Item']['DIMENSION_D'] . "'" : null),
                'POWER_FACTOR' => (isset($item['Item']['POWER_FACTOR']) ? "'" . $item['Item']['POWER_FACTOR'] . "'" : null),
                'LUMEN_FACTOR' => (isset($item['Item']['LUMEN_FACTOR']) ? "'" . $item['Item']['LUMEN_FACTOR'] . "'" : null),
                'DIMMER' => (isset($item['Item']['DIMMER']) ? "'" . $item['Item']['DIMMER'] . "'" : null),
                'ENCLAS' => (isset($item['Item']['ENCLAS']) ? "'" . $item['Item']['ENCLAS'] . "'" : null),
                'KWIK' => (isset($item['Item']['KWIK']) ? "'" . $item['Item']['KWIK'] . "'" : null),
                'VOLTAGE' => (isset($item['Item']['VOLTAGE']) ? "'" . $item['Item']['VOLTAGE'] . "'" : null),
                'AMPERE' => (isset($item['Item']['AMPERE']) ? "'" . $item['Item']['AMPERE'] . "'" : null),
                'COMPAR' => (isset($item['Item']['COMPAR']) ? "'" . $item['Item']['COMPAR'] . "'" : null),
                'FITTIN' => (isset($item['Item']['FITTIN']) ? "'" . $item['Item']['FITTIN'] . "'" : null),
                'LICHTB' => (isset($item['Item']['LICHTB']) ? "'" . $item['Item']['LICHTB'] . "'" : null),
                'SHAPE' => (isset($item['Item']['SHAPE']) ? "'" . $item['Item']['SHAPE'] . "'" : null),
                'LED_Type' => (isset($item['Item']['LED_Type']) ? "'" . $item['Item']['LED_Type'] . "'" : null),
                'LED_NUMBER' => (isset($item['Item']['LED_NUMBER']) ? "'" . $item['Item']['LED_NUMBER'] . "'" : null),
                'UV' => ($item['Item']['UV'] == 0 ? 0 : 1),
                'TEST_DATE' => (isset($item['Item']['TEST_DATE']) ? "'" . $item['Item']['TEST_DATE'] . "'" : null),
                'T6000H_DATE' => (isset($item['Item']['T6000H_DATE']) ? "'" . $item['Item']['T6000H_DATE'] . "'" : null),
                'COLOUR' => (isset($item['Item']['COLOUR']) ? "'" . $item['Item']['COLOUR'] . "'" : null),
                'BEAM_R' => (isset($item['Item']['BEAM_R']) ? "'" . $item['Item']['BEAM_R'] . "'" : null),
                'INDOOR' => (isset($item['Item']['INDOOR']) ? "'" . $item['Item']['INDOOR'] . "'" : null),
                'SPECTRUM' => (isset($item['Item']['SPECTRUM']) ? "'" . $item['Item']['SPECTRUM'] . "'" : null)
                    ), array('ITEM_S' => $this->Item->field('ITEM_S'))
            );
            $this->Session->setFlash('All ErP info has been copied', 'default', array('class' => 'success'));
            $this->redirect(array('action' => 'view/' . $id));
        }
    }

    public function createFolder($id = null) {
        $item = $this->Item->findById($id);
        $this->Item->id = $id;
        $item_folder = str_replace('/', '_', $this->Item->field('ITEM'));
        $certDirectory = 'img' . DS . 'G' . DS . 'QC' . DS . 'Certificates' . DS . $item_folder;
        $certSubDirectory = $certDirectory . DS . '(' . (($this->Item->field('ITEM_S')=='') ? $this->Item->field('ITEM') : $this->Item->field('ITEM_S')) . ')_' . str_replace('.', '', (($this->Item->field('SUPPLIER')=='') ? 'XXX' : $this->Item->field('SUPPLIER')));
        if ($this->request->is('post') || $this->request->is('put')) {
            mkdir($certSubDirectory . DS . 'Correspondence & QC', 0755, true);
            mkdir($certSubDirectory . DS . '_Done', 0755, true);
            $this->Session->setFlash('Folder has been created', 'default', array('class' => 'success'));
            $this->redirect(array('action' => 'edit/' . $id));
        }
    }

    public function createPC($id = null) {
        $item = $this->Item->findById($id);
        $sapWithoutDots = $sapWithoutDots = str_replace('.', '', $item['Item']['SAP']);
        if ($this->request->is('post') || $this->request->is('put')) {
            mkdir('img' . DS . 'X' . DS . 'Smartwares - Product Content' . DS . 'PRODUCTS' . DS . $sapWithoutDots, 0755, true);
            $this->Session->setFlash('PRODUCT CONTENT folder has been created', 'default', array('class' => 'success'));
            $this->redirect(array('action' => 'edit/' . $id));
        }
    }

    public function delete($id) {
        if ($this->request->is('get')) {
            throw new MethodNotAllowedException();
        }
        if ($this->Item->delete($id)) {
            $this->Session->setFlash('Product id: ' . $id . ' has been deleted');
            $this->redirect(array('action' => 'index'));
        }
    }

}

?>