<?php

class SuppliersController extends AppController {

    public $helpers = array('Html', 'Form');
    public $paginate = array(
        'order' => array('Supplier.SUPPLIER' => 'asc'),
        'maxLimit' => ''
    );

    public function flash($message, $class = 'status') {
        $old = $this->Session->read('messages');
        $old[$class][] = $message;
        $this->Session->write('messages', $old);
    }

    public function sindex() {
        $supplier_ch = (isset($this->request->query['filter']) ? $this->request->query['filter'] : 'ARTURO');

        if (empty($this->request->query['filter'])) {
            $supplier_ch = '%';
        }
        $this->set('suppliers', $this->paginate('Supplier', array("Supplier.SUPPLIER like '%{$supplier_ch}%' OR Supplier.OFFICE_VENDOR like '%{$supplier_ch}%' "
                    . "OR Supplier.OFFICE_VENDOR_SFE like '%{$supplier_ch}%' OR Supplier.OFFICE_NAME like '%{$supplier_ch}%' OR Supplier.OFFICE_NAME1 like '%{$supplier_ch}%' "
                    . "OR Supplier.OFFICE_NAME2 like '%{$supplier_ch}%' OR Supplier.OFFICE_ADDRESS1 like '%{$supplier_ch}%' OR Supplier.OFFICE_ADDRESS2 like '%{$supplier_ch}%' "
                    . "OR Supplier.OFFICE_ADDRESS3 like '%{$supplier_ch}%' OR Supplier.OFFICE_CITY like '%{$supplier_ch}%' OR Supplier.OFFICE_PROVINCE like '%{$supplier_ch}%' "
                    . "OR Supplier.OFFICE_COUNTRY like '%{$supplier_ch}%' OR Supplier.OFFICE_ZIP like '%{$supplier_ch}%' "
                    . "OR Supplier.FACTORY1_VENDOR like '%{$supplier_ch}%' OR Supplier.FACTORY1_NAME like '%{$supplier_ch}%' OR Supplier.FACTORY1_NAME1 like '%{$supplier_ch}%' "
                    . "OR Supplier.FACTORY1_NAME2 like '%{$supplier_ch}%' OR Supplier.FACTORY1_ADDRESS1 like '%{$supplier_ch}%' OR Supplier.FACTORY1_ADDRESS2 like '%{$supplier_ch}%' "
                    . "OR Supplier.FACTORY1_ADDRESS3 like '%{$supplier_ch}%' OR Supplier.FACTORY1_CITY like '%{$supplier_ch}%' OR Supplier.FACTORY1_PROVINCE like '%{$supplier_ch}%' "
                    . "OR Supplier.FACTORY1_COUNTRY like '%{$supplier_ch}%' OR Supplier.FACTORY1_ZIP like '%{$supplier_ch}%'"
                    . "OR Supplier.FACTORY2_VENDOR like '%{$supplier_ch}%' OR Supplier.FACTORY2_NAME like '%{$supplier_ch}%' OR Supplier.FACTORY2_NAME1 like '%{$supplier_ch}%' "
                    . "OR Supplier.FACTORY2_NAME2 like '%{$supplier_ch}%' OR Supplier.FACTORY2_ADDRESS1 like '%{$supplier_ch}%' OR Supplier.FACTORY2_ADDRESS2 like '%{$supplier_ch}%' "
                    . "OR Supplier.FACTORY2_ADDRESS3 like '%{$supplier_ch}%' OR Supplier.FACTORY2_CITY like '%{$supplier_ch}%' OR Supplier.FACTORY2_PROVINCE like '%{$supplier_ch}%' "
                    . "OR Supplier.FACTORY2_COUNTRY like '%{$supplier_ch}%' OR Supplier.FACTORY2_ZIP like '%{$supplier_ch}%'"
                    . "OR Supplier.FACTORY3_VENDOR like '%{$supplier_ch}%' OR Supplier.FACTORY3_NAME like '%{$supplier_ch}%' OR Supplier.FACTORY3_NAME1 like '%{$supplier_ch}%' "
                    . "OR Supplier.FACTORY3_NAME2 like '%{$supplier_ch}%' OR Supplier.FACTORY3_ADDRESS1 like '%{$supplier_ch}%' OR Supplier.FACTORY3_ADDRESS2 like '%{$supplier_ch}%' "
                    . "OR Supplier.FACTORY3_ADDRESS3 like '%{$supplier_ch}%' OR Supplier.FACTORY3_CITY like '%{$supplier_ch}%' OR Supplier.FACTORY3_PROVINCE like '%{$supplier_ch}%' "
                    . "OR Supplier.FACTORY3_COUNTRY like '%{$supplier_ch}%' OR Supplier.FACTORY3_ZIP like '%{$supplier_ch}%' OR Supplier.NOTE like '%{$supplier_ch}%'")));
    }

    public function sview($id = null) {
        if (!$id) {
            throw new NotFoundException(__('Supplier does not exist'));
        }
        $supplier = $this->Supplier->findById($id);
        if (!$supplier) {
            throw new NotFoundException(__('Supplier does not exist'));
        }
        $this->set('supplier', $supplier);
        
        if (!$this->request->data) {
            $this->request->data = $supplier;
        }
    }

    public function sadd() {
        if ($this->request->is('post')) {
            $this->Supplier->create();
            if ($this->Supplier->save($this->request->data)) {
                $this->Session->setFlash('Supplier has been saved');
                $this->redirect(array('action' => 'sindex'));
            } else {
                $this->Session->setFlash('Saving supplier error');
            }
        }
    }

    public function sedit($id = null) {
        if (!$id) {
            throw new NotFoundException(__('Supplier does not exist'));
        }
        $supplier = $this->Supplier->findById($id);
        if (!$supplier) {
            throw new NotFoundException(__('Supplier does not exist'));
        }
        if ($this->request->is('post') || $this->request->is('put')) {
            $this->Supplier->id = $id;
            if ($this->Supplier->save($this->request->data)) {
                $this->Session->setFlash('Supplier has been modified', 'default', array('class' => 'success'));
                $this->redirect(array('action' => 'sview/' . $id));
            } else {
                $this->Session->setFlash('Editing supplier error');
            }
        }
        $this->set('supplier', $supplier);
        if (!$this->request->data) {
            $this->request->data = $supplier;
        }
    }

    public function sdelete($id) {
        if (!$this->request->is('get')) {
            throw new MethodNotAllowedException();
        }
        if ($this->Supplier->delete($id)) {
            $this->Session->setFlash('Supplier id: ' . $id . ' has been deleted');
            $this->redirect(array('action' => 'sindex'));
        } else {
            $this->Session->setFlash('Supplier id: ' . $id . ' has not been deleted');
            $this->redirect(array('action' => 'sindex'));
        }
    }

}

?>