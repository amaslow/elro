<?php
echo $this->Form->create('Supplier', array(
    'inputDefaults' => array(
        'label' => false,
        'div' => false
    )
));
?>
<table class="toptable" style="margin-bottom: 0px;">
    <tr>
        <td><?php echo $this->Form->input('SUPPLIER', array('label' => 'Supplier:', 'size' => '75', 'style' => 'font-size: 20px;')); ?></td>
        <td><?php echo $this->Form->input('OFFICE_VENDOR', array('label' => 'SAP Office:', 'size' => '5', 'style' => 'font-size: 20px;')); ?></td>
        <td><?php echo $this->Form->input('OFFICE_VENDOR_SFE', array('label' => 'SFE SAP:', 'size' => '5', 'style' => 'font-size: 20px;')); ?></td>
    </tr>
</table>
<table class="sup_bsci" align="right">
    <tr>
        <td>Buyer:</td>
        <td><?php echo $this->Form->input('BUYER', array('options'=>array("Dennis"=>"Dennis","Mark"=>"Mark", "Dennis / Mark"=>"Dennis / Mark"),'empty' =>'','selected'=>$supplier['Supplier']['BUYER']));?></td>
        <td>Strategic FOB supplier:</td>
        <td><?php echo $this->Form->input('FOB', array('div' => false, 'type' => 'checkbox'));?></td>
    </tr>
</table>
<p> </br></p>
<table class="sup_contact">
    <label style="font-weight: bolder;">Contact details</label>
    <tr><td>
            <table>
                <tr><th style="border-bottom: none;"></th>
                    <th>Office</th>
                    <th>Factory 1</th>
                    <th>Factory 2</th>
                    <th>Factory 3</th>
                    <th>Note</th>
                </tr>
                <tr>
                    <td style="font-weight: bolder;">SAP number:</td>
                    <td><?php echo $this->Form->input('OFFICE_VENDOR',array('size' => '5')); ?></td>
                    <td><?php echo $this->Form->input('FACTORY1_VENDOR',array('size' => '5')); ?></td>
                    <td><?php echo $this->Form->input('FACTORY2_VENDOR',array('size' => '5')); ?></td>
                    <td><?php echo $this->Form->input('FACTORY3_VENDOR',array('size' => '5')); ?></td>
                    <td rowspan="12" style="vertical-align: top;"><?php echo $this->Form->textarea('NOTE', array('rows' => '20', 'cols' => '50')); ?></td>
                </tr>
                <tr>
                    <td rowspan="2" style="padding-bottom: 0; font-weight: bolder;">Name:</td>
                    <td style="border-bottom: none; padding-bottom: 0;"><?php echo $this->Form->input('OFFICE_NAME1',array('size' => '35')); ?></td>
                    <td style="border-bottom: none; padding-bottom: 0;"><?php echo $this->Form->input('FACTORY1_NAME1',array('size' => '35')); ?></td>
                    <td style="border-bottom: none; padding-bottom: 0;"><?php echo $this->Form->input('FACTORY2_NAME1',array('size' => '35')); ?></td>
                    <td style="border-bottom: none; padding-bottom: 0;"><?php echo $this->Form->input('FACTORY3_NAME1',array('size' => '35')); ?></td>
                </tr>
                <tr>
                    <td style="padding-top: 0;"><?php echo $this->Form->input('OFFICE_NAME2',array('size' => '35')); ?></td>
                    <td style="padding-top: 0;"><?php echo $this->Form->input('FACTORY1_NAME2',array('size' => '35')); ?></td>
                    <td style="padding-top: 0;"><?php echo $this->Form->input('FACTORY2_NAME2',array('size' => '35')); ?></td>
                    <td style="padding-top: 0;"><?php echo $this->Form->input('FACTORY3_NAME2',array('size' => '35')); ?></td>
                </tr>
                <tr>
                    <td rowspan="3" style="padding-bottom: 0; font-weight: bolder;">Address:</td>
                    <td style="border-bottom: none; padding-bottom: 0;"><?php echo $this->Form->input('OFFICE_ADDRESS1',array('size' => '35')); ?></td>
                    <td style="border-bottom: none; padding-bottom: 0;"><?php echo $this->Form->input('FACTORY1_ADDRESS1',array('size' => '35')); ?></td>
                    <td style="border-bottom: none; padding-bottom: 0;"><?php echo $this->Form->input('FACTORY2_ADDRESS1',array('size' => '35')); ?></td>
                    <td style="border-bottom: none; padding-bottom: 0;"><?php echo $this->Form->input('FACTORY3_ADDRESS1',array('size' => '35')); ?></td>
                </tr>
                <tr>
                    <td style="border-bottom: none; padding-bottom: 0;"><?php echo $this->Form->input('OFFICE_ADDRESS2',array('size' => '35')); ?></td>
                    <td style="border-bottom: none; padding-bottom: 0;"><?php echo $this->Form->input('FACTORY1_ADDRESS2',array('size' => '35')); ?></td>
                    <td style="border-bottom: none; padding-bottom: 0;"><?php echo $this->Form->input('FACTORY2_ADDRESS2',array('size' => '35')); ?></td>
                    <td style="border-bottom: none; padding-bottom: 0;"><?php echo $this->Form->input('FACTORY3_ADDRESS2',array('size' => '35')); ?></td>
                </tr>
                <tr>
                    <td style="padding-top: 0;"><?php echo $this->Form->input('OFFICE_ADDRESS3',array('size' => '35')); ?></td>
                    <td style="padding-top: 0;"><?php echo $this->Form->input('FACTORY1_ADDRESS3',array('size' => '35')); ?></td>
                    <td style="padding-top: 0;"><?php echo $this->Form->input('FACTORY2_ADDRESS3',array('size' => '35')); ?></td>
                    <td style="padding-top: 0;"><?php echo $this->Form->input('FACTORY3_ADDRESS3',array('size' => '35')); ?></td>
                </tr>
                <tr>
                    <td style="font-weight: bolder;">City:</td>
                    <td><?php echo $this->Form->input('OFFICE_CITY',array('size' => '35')); ?></td>
                    <td><?php echo $this->Form->input('FACTORY1_CITY',array('size' => '35')); ?></td>
                    <td><?php echo $this->Form->input('FACTORY2_CITY',array('size' => '35')); ?></td>
                    <td><?php echo $this->Form->input('FACTORY3_CITY',array('size' => '35')); ?></td>
                </tr>
                <tr>
                    <td style="font-weight: bolder;">State/Province:</td>
                    <td><?php echo $this->Form->input('OFFICE_PROVINCE',array('size' => '35')); ?></td>
                    <td><?php echo $this->Form->input('FACTORY1_PROVINCE',array('size' => '35')); ?></td>
                    <td><?php echo $this->Form->input('FACTORY2_PROVINCE',array('size' => '35')); ?></td>
                    <td><?php echo $this->Form->input('FACTORY3_PROVINCE',array('size' => '35')); ?></td>
                </tr>
                <tr>
                    <td style="font-weight: bolder;">Country:</td>
                    <td><?php echo $this->Form->input('OFFICE_COUNTRY',array('size' => '35')); ?></td>
                    <td><?php echo $this->Form->input('FACTORY1_COUNTRY',array('size' => '35')); ?></td>
                    <td><?php echo $this->Form->input('FACTORY2_COUNTRY',array('size' => '35')); ?></td>
                    <td><?php echo $this->Form->input('FACTORY3_COUNTRY',array('size' => '35')); ?></td>
                </tr>
                <tr>
                    <td style="font-weight: bolder;">Zipcode:</td>
                    <td><?php echo $this->Form->input('OFFICE_ZIP'); ?></td>
                    <td><?php echo $this->Form->input('FACTORY1_ZIP'); ?></td>
                    <td><?php echo $this->Form->input('FACTORY2_ZIP'); ?></td>
                    <td><?php echo $this->Form->input('FACTORY3_ZIP'); ?></td>
                </tr>
                <tr>
                    <td style="font-weight: bolder;">Web:</td>
                    <td><?php echo $this->Form->input('OFFICE_WWW', array('size' => '35')); ?></td>
                    <td><?php echo $this->Form->input('FACTORY1_WWW', array('size' => '35')); ?></td>
                    <td><?php echo $this->Form->input('FACTORY2_WWW', array('size' => '35')); ?></td>
                    <td><?php echo $this->Form->input('FACTORY3_WWW', array('size' => '35')); ?></td>
                </tr>
                <tr>
                    <td style="font-weight: bolder;">DB_ID:</td>
                    <td><?php echo $this->Form->input('DB_ID'); ?></td>
                    <td><?php echo $this->Form->input('DB_ID1'); ?></td>
                    <td><?php echo $this->Form->input('DB_ID2'); ?></td>
                    <td><?php echo $this->Form->input('DB_ID3'); ?></td>
                </tr>
            </table>
        </td></tr>
    <tr><td>
            <table>
                <tr>
                    <th style="border-bottom: none;"></th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Function</th>
                </tr>
<?php
function extract_emails_from($string) {
    preg_match("/[\._a-zA-Z0-9-]+@[\._a-zA-Z0-9-]+/i", $string, $matches);
    return $matches[0];
}
?>
                <tr>
                    <td style="font-weight: bolder;">Contact person 1:</td>
                    <td><?php echo $this->Form->input('CONTACT1_NAME', array('size' => '35')); ?></td>
                    <td><?php echo $this->Form->input('CONTACT1_EMAIL', array('size' => '35'));?></td>
                    <td><?php echo $this->Form->input('CONTACT1_PHONE', array('size' => '35')); ?></td>
                    <td><?php echo $this->Form->input('CONTACT1_FUNCTION', array('size' => '35')); ?></td>
                </tr>
                <tr>
                    <td style="font-weight: bolder;">Contact person 2:</td>
                    <td><?php echo $this->Form->input('CONTACT2_NAME', array('size' => '35')); ?></td>
                    <td><?php echo $this->Form->input('CONTACT2_EMAIL', array('size' => '35')); ?></td>
                    <td><?php echo $this->Form->input('CONTACT2_PHONE', array('size' => '35')); ?></td>
                    <td><?php echo $this->Form->input('CONTACT2_FUNCTION', array('size' => '35')); ?></td>
                </tr>
                <tr>
                    <td style="font-weight: bolder;">Contact person 3:</td>
                    <td><?php echo $this->Form->input('CONTACT3_NAME', array('size' => '35')); ?></td>
                    <td><?php echo $this->Form->input('CONTACT3_EMAIL', array('size' => '35')); ?></td>
                    <td><?php echo $this->Form->input('CONTACT3_PHONE', array('size' => '35')); ?></td>
                    <td><?php echo $this->Form->input('CONTACT3_FUNCTION', array('size' => '35')); ?></td>
                </tr>
                <tr>
                    <td style="font-weight: bolder;">Contact person 4:</td>
                    <td><?php echo $this->Form->input('CONTACT4_NAME', array('size' => '35')); ?></td>
                    <td><?php echo $this->Form->input('CONTACT4_EMAIL', array('size' => '35')); ?></td>
                    <td><?php echo $this->Form->input('CONTACT4_PHONE', array('size' => '35')); ?></td>
                    <td><?php echo $this->Form->input('CONTACT4_FUNCTION', array('size' => '35')); ?></td>
                </tr>
                <tr>
                    <td style="font-weight: bolder;">Contact person 5:</td>
                    <td><?php echo $this->Form->input('CONTACT5_NAME', array('size' => '35')); ?></td>
                    <td><?php echo $this->Form->input('CONTACT5_EMAIL', array('size' => '35')); ?></td>
                    <td><?php echo $this->Form->input('CONTACT5_PHONE', array('size' => '35')); ?></td>
                    <td><?php echo $this->Form->input('CONTACT5_FUNCTION', array('size' => '35')); ?></td>
                </tr>
                <tr>
                    <td style="font-weight: bolder;">Contact person 6:</td>
                    <td><?php echo $this->Form->input('CONTACT6_NAME', array('size' => '35')); ?></td>
                    <td><?php echo $this->Form->input('CONTACT6_EMAIL', array('size' => '35')); ?></td>
                    <td><?php echo $this->Form->input('CONTACT6_PHONE', array('size' => '35')); ?></td>
                    <td><?php echo $this->Form->input('CONTACT6_FUNCTION', array('size' => '35')); ?></td>
                </tr>
            </table>
        </td></tr>
</table>
<table class="sup_bsci">
    <label style="font-weight: bolder; color: darkblue;">CSR BSCI</label>
    <tr>
        <td>Participation required:</td>
        <td><?php echo $this->Form->input('BSCI_PART', array('options'=>array("Required"=>"Required","Not Required"=>"Not Required"),'empty' =>'','selected'=>$supplier['Supplier']['BSCI_PART'])); ?></td>
        <td>Audit result:</td>
        <td><?php echo $this->Form->input('BSCI_RESULT', array('options'=>array("Good"=>"Good","Improvements Needed"=>"Improvements Needed", "Non Compliant"=>"Non Compliant",
            "---------------------------"=>"---------------------------","A-Outstanding"=>"A-Outstanding","B-Good"=>"B-Good","C-Acceptable"=>"C-Acceptable","D-Insufficient"=>"D-Insufficient","E-Unacceptable"=>"E-Unacceptable",
            "Zero Compliance"=>"Zero Compliance"),'empty' =>'','selected'=>$supplier['Supplier']['BSCI_RESULT']));?></td>
        <td>Auditcycle valid from:</td>
        <td><?php echo $this->Form->input('BSCI_FROM', array('type' => 'text','title'=>'YYYY-MM-DD', 'size' => '9')); ?></td>
        <td>Valid till:</td>
        <td><?php echo $this->Form->input('BSCI_TILL', array('type' => 'text','title'=>'YYYY-MM-DD', 'size' => '9')); ?></td>
    </tr>
    <tr>
        <td>Other participations 1:</td>
        <td colspan="3"><?php echo $this->Form->input('BSCI_OTHER1_NAME', array('size' => '70')); ?></td>
        <td>Valid from:</td>
        <td><?php echo $this->Form->input('BSCI_OTHER1_FROM', array('type' => 'text','title'=>'YYYY-MM-DD', 'size' => '9')); ?></td>
        <td>Valid till:</td>
        <td><?php echo $this->Form->input('BSCI_OTHER1_TILL', array('type' => 'text','title'=>'YYYY-MM-DD', 'size' => '9')); ?></td>
    </tr>
    <tr>
        <td>Other participations 2:</td>
        <td colspan="3"><?php echo $this->Form->input('BSCI_OTHER2_NAME', array('size' => '70')); ?></td>
        <td>Valid from:</td>
        <td><?php echo $this->Form->input('BSCI_OTHER2_FROM', array('type' => 'text','title'=>'YYYY-MM-DD', 'size' => '9')); ?></td>
        <td>Valid till:</td>
        <td><?php echo $this->Form->input('BSCI_OTHER2_TILL', array('type' => 'text','title'=>'YYYY-MM-DD', 'size' => '9')); ?></td>
    </tr>
    <tr>
        <td>Other participations 3:</td>
        <td colspan="3"><?php echo $this->Form->input('BSCI_OTHER3_NAME', array('size' => '70')); ?></td>
        <td>Valid from:</td>
        <td><?php echo $this->Form->input('BSCI_OTHER3_FROM', array('type' => 'text','title'=>'YYYY-MM-DD', 'size' => '9')); ?></td>
        <td>Valid till:</td>
        <td><?php echo $this->Form->input('BSCI_OTHER3_TILL', array('type' => 'text','title'=>'YYYY-MM-DD', 'size' => '9')); ?></td>
    </tr>
</table>
<table style="width: auto;">
    <tr>
    <td style="vertical-align: auto;">
<table class="sup_cert">
    <label style="font-weight: bolder; color: darkgreen;">Certification</label>
    <tr>
        <th style="border-bottom: none;"></th>
        <th>Valid from</th>
        <th>Valid till</th>
        <th>Auditing company</th>
    </tr>
    <tr>
        <td style="font-weight: bold;"><?php echo $this->Form->input('CERT_ISO9000'); ?></td>
        <td><?php echo $this->Form->input('CERT_ISO9000_FROM', array('type' => 'text','title'=>'YYYY-MM-DD', 'size' => '9')); ?></td>
        <td><?php echo $this->Form->input('CERT_ISO9000_TILL', array('type' => 'text','title'=>'YYYY-MM-DD', 'size' => '9')); ?></td>
        <td><?php echo $this->Form->input('CERT_ISO9000_NAME', array('size' => '50')); ?></td>
    </tr>
    <tr>
        <td style="font-weight: bold;"><?php echo $this->Form->input('CERT_ISO14000'); ?></td>
        <td><?php echo $this->Form->input('CERT_ISO14000_FROM', array('type' => 'text','title'=>'YYYY-MM-DD', 'size' => '9')); ?></td>
        <td><?php echo $this->Form->input('CERT_ISO14000_TILL', array('type' => 'text','title'=>'YYYY-MM-DD', 'size' => '9')); ?></td>
        <td><?php echo $this->Form->input('CERT_ISO14000_NAME', array('size' => '50')); ?></td>
    </tr>
    <tr>
        <td style="font-weight: bold;"><?php echo $this->Form->input('CERT_OTHER1'); ?></td>
        <td><?php echo $this->Form->input('CERT_OTHER1_FROM', array('type' => 'text','title'=>'YYYY-MM-DD', 'size' => '9')); ?></td>
        <td><?php echo $this->Form->input('CERT_OTHER1_TILL', array('type' => 'text','title'=>'YYYY-MM-DD', 'size' => '9')); ?></td>
        <td><?php echo $this->Form->input('CERT_OTHER1_NAME', array('size' => '50')); ?></td>
    </tr>
    <tr>
        <td style="font-weight: bold;"><?php echo $this->Form->input('CERT_OTHER2'); ?></td>
        <td><?php echo $this->Form->input('CERT_OTHER2_FROM', array('type' => 'text','title'=>'YYYY-MM-DD', 'size' => '9')); ?></td>
        <td><?php echo $this->Form->input('CERT_OTHER2_TILL', array('type' => 'text','title'=>'YYYY-MM-DD', 'size' => '9')); ?></td>
        <td><?php echo $this->Form->input('CERT_OTHER2_NAME', array('size' => '50')); ?></td>
    </tr>
    <tr>
        <td style="font-weight: bold;"><?php echo $this->Form->input('CERT_OTHER3'); ?></td>
        <td><?php echo $this->Form->input('CERT_OTHER3_FROM', array('type' => 'text','title'=>'YYYY-MM-DD', 'size' => '9')); ?></td>
        <td><?php echo $this->Form->input('CERT_OTHER3_TILL', array('type' => 'text','title'=>'YYYY-MM-DD', 'size' => '9')); ?></td>
        <td><?php echo $this->Form->input('CERT_OTHER3_NAME', array('size' => '50')); ?></td>
    </tr>
    <tr>
        <td style="font-weight: bold;"><?php echo $this->Form->input('CERT_OTHER4'); ?></td>
        <td><?php echo $this->Form->input('CERT_OTHER4_FROM', array('type' => 'text','title'=>'YYYY-MM-DD', 'size' => '9')); ?></td>
        <td><?php echo $this->Form->input('CERT_OTHER4_TILL', array('type' => 'text','title'=>'YYYY-MM-DD', 'size' => '9')); ?></td>
        <td><?php echo $this->Form->input('CERT_OTHER4_NAME', array('size' => '50')); ?></td>
    </tr>
    <tr>
        <td style="font-weight: bold;"><?php echo $this->Form->input('CERT_OTHER5'); ?></td>
        <td><?php echo $this->Form->input('CERT_OTHER5_FROM', array('type' => 'text','title'=>'YYYY-MM-DD', 'size' => '9')); ?></td>
        <td><?php echo $this->Form->input('CERT_OTHER5_TILL', array('type' => 'text','title'=>'YYYY-MM-DD', 'size' => '9')); ?></td>
        <td><?php echo $this->Form->input('CERT_OTHER5_NAME', array('size' => '50')); ?></td>
    </tr>
    <tr>
        <td style="font-weight: bold;"><?php echo $this->Form->input('CERT_OTHER6'); ?></td>
        <td><?php echo $this->Form->input('CERT_OTHER6_FROM', array('type' => 'text','title'=>'YYYY-MM-DD', 'size' => '9')); ?></td>
        <td><?php echo $this->Form->input('CERT_OTHER6_TILL', array('type' => 'text','title'=>'YYYY-MM-DD', 'size' => '9')); ?></td>
        <td><?php echo $this->Form->input('CERT_OTHER6_NAME', array('size' => '50')); ?></td>
    </tr>
    <tr>
        <td style="font-weight: bold;"><?php echo $this->Form->input('CERT_OTHER7'); ?></td>
        <td><?php echo $this->Form->input('CERT_OTHER7_FROM', array('type' => 'text','title'=>'YYYY-MM-DD', 'size' => '9')); ?></td>
        <td><?php echo $this->Form->input('CERT_OTHER7_TILL', array('type' => 'text','title'=>'YYYY-MM-DD', 'size' => '9')); ?></td>
        <td><?php echo $this->Form->input('CERT_OTHER7_NAME', array('size' => '50')); ?></td>
    </tr>
    <tr>
        <td style="font-weight: bold;"><?php echo $this->Form->input('CERT_OTHER8'); ?></td>
        <td><?php echo $this->Form->input('CERT_OTHER8_FROM', array('type' => 'text','title'=>'YYYY-MM-DD', 'size' => '9')); ?></td>
        <td><?php echo $this->Form->input('CERT_OTHER8_TILL', array('type' => 'text','title'=>'YYYY-MM-DD', 'size' => '9')); ?></td>
        <td><?php echo $this->Form->input('CERT_OTHER8_NAME', array('size' => '50')); ?></td>
    </tr>
    <tr>
        <td style="font-weight: bold;"><?php echo $this->Form->input('CERT_OTHER9'); ?></td>
        <td><?php echo $this->Form->input('CERT_OTHER9_FROM', array('type' => 'text','title'=>'YYYY-MM-DD', 'size' => '9')); ?></td>
        <td><?php echo $this->Form->input('CERT_OTHER9_TILL', array('type' => 'text','title'=>'YYYY-MM-DD', 'size' => '9')); ?></td>
        <td><?php echo $this->Form->input('CERT_OTHER9_NAME', array('size' => '50')); ?></td>
    </tr>
    <tr>
        <td style="font-weight: bold;"><?php echo $this->Form->input('CERT_OTHER10'); ?></td>
        <td><?php echo $this->Form->input('CERT_OTHER10_FROM', array('type' => 'text','title'=>'YYYY-MM-DD', 'size' => '9')); ?></td>
        <td><?php echo $this->Form->input('CERT_OTHER10_TILL', array('type' => 'text','title'=>'YYYY-MM-DD', 'size' => '9')); ?></td>
        <td><?php echo $this->Form->input('CERT_OTHER10_NAME', array('size' => '50')); ?></td>
    </tr>
</table>
</td>
<td style="vertical-align: auto;">
<table class="sup_decl">
    <label style="font-weight: bolder; color: darkblue;">Declaration
        <span><?php echo 'Payments: ' . $this->Form->input('DECL_PAY', array('options'=>array("IB00"=>"IB00","IB10"=>"IB10","IB11"=>"IB11","IB12"=>"IB12","IB19"=>"IB19",
            "IB20"=>"IB20","IB21"=>"IB21","IB43"=>"IB43","IB49"=>"IB49","IB84"=>"IB84","IB90"=>"IB90","IB91"=>"IB91","IB95"=>"IB95","IBA2"=>"IBA2","IBA5"=>"IBA5","IBA7"=>"IBA7",
            "IBE4"=>"IBE4","IBF1"=>"IBF1","IBF3"=>"IBF3","IBF8"=>"IBF8","IBH7"=>"IBH7","IBH8"=>"IBH8","IBH9"=>"IBH9","VC68"=>"VC68"),'empty' =>'','selected'=>$supplier['Supplier']['DECL_PAY'])); ?></span>
    </label>
    <tr>
        <th>Received</th>
        <th>Date signed</th>
    </tr>
    <tr>
        <td><?php echo $this->Form->input('DECL_BRAND', array('div' => false, 'type' => 'checkbox')) .'Brand authorization';?></td>
        <td><?php echo $this->Form->input('DECL_BRAND_DATE', array('type' => 'text','title'=>'YYYY-MM-DD', 'size' => '9')); ?></td>
    </tr>
    <tr>
        <td><?php echo $this->Form->input('DECL_SDA', array('div' => false, 'type' => 'checkbox')) .'SDA'?></td>
        <td><?php echo $this->Form->input('DECL_SDA_DATE', array('type' => 'text','title'=>'YYYY-MM-DD', 'size' => '9')) ;?></td>
    </tr>
    <tr>
        <td><?php echo $this->Form->input('DECL_PACK', array('div' => false, 'type' => 'checkbox')) .'Packaging & Packaging waste'?></td>
        <td><?php echo $this->Form->input('DECL_PACK_DATE', array('type' => 'text','title'=>'YYYY-MM-DD', 'size' => '9')) ;?></td>
    </tr>
    <tr>
        <td><?php echo $this->Form->input('DECL_SOP', array('div' => false, 'type' => 'checkbox')) .'SOP'?></td>
        <td><?php echo $this->Form->input('DECL_SOP_DATE', array('type' => 'text','title'=>'YYYY-MM-DD', 'size' => '9')) ;?></td>
    </tr>
    <tr>
        <td><?php echo $this->Form->input('DECL_CONTR', array('div' => false, 'type' => 'checkbox')) .'Confidentiality agreement'?></td>
        <td><?php echo $this->Form->input('DECL_CONTR_DATE', array('type' => 'text','title'=>'YYYY-MM-DD', 'size' => '9')) ;?></td>
    </tr>
    <tr>
        <td><?php echo $this->Form->input('DECL_REACH', array('div' => false, 'type' => 'checkbox')) .'REACH'?></td>
        <td><?php echo $this->Form->input('DECL_REACH_DATE', array('type' => 'text','title'=>'YYYY-MM-DD', 'size' => '9')) ;?></td>
    </tr>
    <tr>
        <td><?php echo $this->Form->input('DECL_ROHS', array('div' => false, 'type' => 'checkbox')) .'RoHS'?></td>
        <td><?php echo $this->Form->input('DECL_ROHS_DATE', array('type' => 'text','title'=>'YYYY-MM-DD', 'size' => '9')) ;?></td>
    </tr>
</table>
</td>
</tr>
<tr>
    <td colspan="2" style="vertical-align: auto;font-weight: bold; color: darkblue;">Warranty agreement:</br>
            <?php echo $this->Form->textarea('DECL_WARRANTY', array('rows' => '6', 'cols' => '150')); ?>
    </td>
</tr>
</table>
<?php
$supplierMainDirectory = "G" . DS . "S&L_Data" . DS . "QC" . DS . "Suppliers" . DS . "Asia" . DS;
if (isset($supplier['Supplier']['FOLDER']) && file_exists('img' . DS . $supplierMainDirectory . $supplier['Supplier']['FOLDER'])) {
    echo $this->Html->link('Folder', array('controller' => 'img' . DS . $supplierMainDirectory . $supplier['Supplier']['FOLDER']), array('target' => '_blank', 'class' => 'button'));
}
echo '<div style="float: right; margin-right: 800px;">';
echo $this->Form->end('Save');
echo '</div>';
?>
<h4 style="float: right">
<?php 
    echo $this->Html->link('Cancel', array('action' => 'sview', $supplier['Supplier']['ID']), array('class' => 'button'));
?>
</h4>
