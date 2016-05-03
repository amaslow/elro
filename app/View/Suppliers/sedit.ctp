<?php
echo $this->Form->create('Supplier');
?>
<table class="toptable" style="margin-bottom: 0px;">
    <tr>
        <td><?php echo $this->Form->input('SUPPLIER', array('label' => 'Supplier:', 'readonly' => 'readonly', 'size' => '75', 'style' => 'font-size: 20px;')); ?></td>
        <td><?php echo $this->Form->input('OFFICE_VENDOR', array('label' => 'SAP Office:', 'readonly' => 'readonly', 'size' => '5', 'style' => 'font-size: 20px;')); ?></td>
        <td><?php echo $this->Form->input('OFFICE_VENDOR_SFE', array('label' => 'SFE SAP:', 'readonly' => 'readonly', 'size' => '5', 'style' => 'font-size: 20px;')); ?></td>
    </tr>
</table>
<table class="sup_bsci" align="right">
    <tr>
        <td>Buyer:</td>
        <td><?php echo $supplier['Supplier']['BUYER']; ?></td>
<!--        <td>QM:</td>
        <td><?php echo $supplier['Supplier']['QM']; ?></td><td></td>-->
        <?php
        if ($supplier['Supplier']['FOB'] == 1) {
            echo '<td style="color:blue;">Strategic FOB supplier</td>';
        }
        ?>
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
                    <?php 
                    if (isset($supplier['Supplier']['FACTORY2_NAME1'])) {
                        echo '<th>Factory 2</th>';
                    }
                    if (isset($supplier['Supplier']['FACTORY3_NAME1'])) {
                        echo '<th>Factory 3</th>';
                    } ?>
                    <th>Note</th>
                </tr>
                <tr>
                    <td style="font-weight: bolder;">SAP number:</td>
                    <td><?php echo $supplier['Supplier']['OFFICE_VENDOR']; ?></td>
                    <?php
                    if (isset($supplier['Supplier']['FACTORY1_NAME1'])) {
                        echo '<td>' . $supplier['Supplier']['FACTORY1_VENDOR'] . '</td>';
                    }
                    if (isset($supplier['Supplier']['FACTORY2_NAME1'])) {
                        echo '<td>' . $supplier['Supplier']['FACTORY2_VENDOR'] . '</td>';
                    }
                    if (isset($supplier['Supplier']['FACTORY3_NAME1'])) {
                        echo '<td>' . $supplier['Supplier']['FACTORY3_VENDOR'] . '</td>';
                    }
                    ?>
                    <td rowspan="12" style="vertical-align: top;"><?php echo $supplier['Supplier']['NOTE']; ?></td>
                </tr>
                <tr>
                    <td rowspan="2" style="padding-bottom: 0; font-weight: bolder;">Name:</td>
                    <td style="border-bottom: none; padding-bottom: 0;"><?php echo $supplier['Supplier']['OFFICE_NAME1']; ?></td>
                    <td style="border-bottom: none; padding-bottom: 0;"><?php echo $supplier['Supplier']['FACTORY1_NAME1']; ?></td>
                    <td style="border-bottom: none; padding-bottom: 0;"><?php echo $supplier['Supplier']['FACTORY2_NAME1']; ?></td>
                    <td style="border-bottom: none; padding-bottom: 0;"><?php echo $supplier['Supplier']['FACTORY3_NAME1']; ?></td>
                </tr>
                <tr>
                    <td style="padding-top: 0;"><?php echo $supplier['Supplier']['OFFICE_NAME2']; ?></td>
                    <td style="padding-top: 0;"><?php echo $supplier['Supplier']['FACTORY1_NAME2']; ?></td>
                    <td style="padding-top: 0;"><?php echo $supplier['Supplier']['FACTORY2_NAME2']; ?></td>
                    <td style="padding-top: 0;"><?php echo $supplier['Supplier']['FACTORY3_NAME2']; ?></td>
                </tr>
                <tr>
                    <td rowspan="3" style="padding-bottom: 0; font-weight: bolder;">Address:</td>
                    <td style="border-bottom: none; padding-bottom: 0;"><?php echo $supplier['Supplier']['OFFICE_ADDRESS1']; ?></td>
                    <td style="border-bottom: none; padding-bottom: 0;"><?php echo $supplier['Supplier']['FACTORY1_ADDRESS1']; ?></td>
                    <td style="border-bottom: none; padding-bottom: 0;"><?php echo $supplier['Supplier']['FACTORY2_ADDRESS1']; ?></td>
                    <td style="border-bottom: none; padding-bottom: 0;"><?php echo $supplier['Supplier']['FACTORY3_ADDRESS1']; ?></td>
                </tr>
                <tr>
                    <td style="border-bottom: none; padding-bottom: 0;"><?php echo $supplier['Supplier']['OFFICE_ADDRESS2']; ?></td>
                    <td style="border-bottom: none; padding-bottom: 0;"><?php echo $supplier['Supplier']['FACTORY1_ADDRESS2']; ?></td>
                    <td style="border-bottom: none; padding-bottom: 0;"><?php echo $supplier['Supplier']['FACTORY2_ADDRESS2']; ?></td>
                    <td style="border-bottom: none; padding-bottom: 0;"><?php echo $supplier['Supplier']['FACTORY3_ADDRESS2']; ?></td>
                </tr>
                <tr>
                    <td style="padding-top: 0;"><?php echo $supplier['Supplier']['OFFICE_ADDRESS3']; ?></td>
                    <td style="padding-top: 0;"><?php echo $supplier['Supplier']['FACTORY1_ADDRESS3']; ?></td>
                    <td style="padding-top: 0;"><?php echo $supplier['Supplier']['FACTORY2_ADDRESS3']; ?></td>
                    <td style="padding-top: 0;"><?php echo $supplier['Supplier']['FACTORY3_ADDRESS3']; ?></td>
                </tr>
                <tr>
                    <td style="font-weight: bolder;">City:</td>
                    <td><?php echo $supplier['Supplier']['OFFICE_CITY']; ?></td>
                    <td><?php echo $supplier['Supplier']['FACTORY1_CITY']; ?></td>
                    <td><?php echo $supplier['Supplier']['FACTORY2_CITY']; ?></td>
                    <td><?php echo $supplier['Supplier']['FACTORY3_CITY']; ?></td>
                </tr>
                <tr>
                    <td style="font-weight: bolder;">State/Province:</td>
                    <td><?php echo $supplier['Supplier']['OFFICE_PROVINCE']; ?></td>
                    <td><?php echo $supplier['Supplier']['FACTORY1_PROVINCE']; ?></td>
                    <td><?php echo $supplier['Supplier']['FACTORY2_PROVINCE']; ?></td>
                    <td><?php echo $supplier['Supplier']['FACTORY3_PROVINCE']; ?></td>
                </tr>
                <tr>
                    <td style="font-weight: bolder;">Country:</td>
                    <td><?php echo $supplier['Supplier']['OFFICE_COUNTRY']; ?></td>
                    <td><?php echo $supplier['Supplier']['FACTORY1_COUNTRY']; ?></td>
                    <td><?php echo $supplier['Supplier']['FACTORY2_COUNTRY']; ?></td>
                    <td><?php echo $supplier['Supplier']['FACTORY3_COUNTRY']; ?></td>
                </tr>
                <tr>
                    <td style="font-weight: bolder;">Zipcode:</td>
                    <td><?php echo $supplier['Supplier']['OFFICE_ZIP']; ?></td>
                    <td><?php echo $supplier['Supplier']['FACTORY1_ZIP']; ?></td>
                    <td><?php echo $supplier['Supplier']['FACTORY2_ZIP']; ?></td>
                    <td><?php echo $supplier['Supplier']['FACTORY3_ZIP']; ?></td>
                </tr>
                <tr>
                    <td style="font-weight: bolder;">Web:</td>
                    <td><?php echo $this->Text->autoLinkUrls($supplier['Supplier']['OFFICE_WWW'], array('target' => '_blank')); ?></td>
                    <td><?php echo $this->Text->autoLinkUrls($supplier['Supplier']['FACTORY1_WWW'], array('target' => '_blank')); ?></td>
                    <td><?php echo $this->Text->autoLinkUrls($supplier['Supplier']['FACTORY2_WWW'], array('target' => '_blank')); ?></td>
                    <td><?php echo $this->Text->autoLinkUrls($supplier['Supplier']['FACTORY3_WWW'], array('target' => '_blank')); ?></td>
                </tr>
                <tr>
                    <td style="font-weight: bolder;">DB_ID:</td>
                    <td><?php echo $supplier['Supplier']['DB_ID']; ?></td>
                    <td><?php echo $supplier['Supplier']['DB_ID1']; ?></td>
                    <td><?php echo $supplier['Supplier']['DB_ID2']; ?></td>
                    <td><?php echo $supplier['Supplier']['DB_ID3']; ?></td>
                </tr>
            </table>
        </td></tr>
    <tr><td>
            <table>
                <tr>
                    <th style="border-bottom: none;"></th>
                    <th>Name</th>
        <!--            <th colspan="4">Name &#8195;&#8195; Email &#8195;&#8195;  Phone  &#8195;&#8195;  Function</th>-->
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Function</th>
        <!--            <th>Email address</th><th>Phone number</th><th>Function</th>-->
                </tr>
<?php

function extract_emails_from($string) {
    preg_match("/[\._a-zA-Z0-9-]+@[\._a-zA-Z0-9-]+/i", $string, $matches);
    return $matches[0];
}
?>
                <tr>
                    <td style="font-weight: bolder;">Contact person 1:</td>
                    <td><?php echo $supplier['Supplier']['CONTACT1_NAME']; ?></td>
        <!--            <td><?php echo $this->Text->autoLinkEmails(extract_emails_from($supplier['Supplier']['CONTACT1'])); ?></td>-->

<!--                    <td><?php echo $this->Text->autoLinkEmails($supplier['Supplier']['CONTACT1_EMAIL']); ?></td>-->
                    <td><a href="mailto:<?php echo $supplier['Supplier']['CONTACT1_EMAIL'];?>?subject=<?php echo 'Complete technical file '.$_GET['subject'];?>&body=Dear <?php echo $supplier['Supplier']['CONTACT1_NAME']; ?>"><?php echo $supplier['Supplier']['CONTACT1_EMAIL'];?></a></td>
                    <td><?php echo $supplier['Supplier']['CONTACT1_PHONE']; ?></td>
                    <td><?php echo $supplier['Supplier']['CONTACT1_FUNCTION']; ?></td>
        <!--            <td colspan="4"><?php echo $supplier['Supplier']['CONTACT1']; ?></td>-->

                </tr>
                <?php
                if (isset($supplier['Supplier']['CONTACT2_NAME']) || isset($supplier['Supplier']['CONTACT2_EMAIL']) || isset($supplier['Supplier']['CONTACT2_PHONE']) || isset($supplier['Supplier']['CONTACT2_FUNCTION'])) {
                    echo '<tr>';
                    ?>
                    <td style="font-weight: bolder;">Contact person 2:</td>
                    <td><?php echo $supplier['Supplier']['CONTACT2_NAME']; ?></td>
                    <td><?php echo $this->Text->autoLinkEmails($supplier['Supplier']['CONTACT2_EMAIL']); ?></td>
                    <td><?php echo $supplier['Supplier']['CONTACT2_PHONE']; ?></td>
                    <td><?php echo $supplier['Supplier']['CONTACT2_FUNCTION']; ?></td>
    <?php
}
echo '</tr>';
if (isset($supplier['Supplier']['CONTACT3_NAME']) || isset($supplier['Supplier']['CONTACT3_EMAIL']) || isset($supplier['Supplier']['CONTACT3_PHONE']) || isset($supplier['Supplier']['CONTACT3_FUNCTION'])) {
    echo '<tr>';
    ?>
                    <td style="font-weight: bolder;">Contact person 3:</td>
                    <td><?php echo $supplier['Supplier']['CONTACT3_NAME']; ?></td>
                    <td><?php echo $this->Text->autoLinkEmails($supplier['Supplier']['CONTACT3_EMAIL']); ?></td>
                    <td><?php echo $supplier['Supplier']['CONTACT3_PHONE']; ?></td>
                    <td><?php echo $supplier['Supplier']['CONTACT3_FUNCTION']; ?></td>
                    <?php
                }
                echo '</tr>';
                if (isset($supplier['Supplier']['CONTACT4_NAME']) || isset($supplier['Supplier']['CONTACT4_EMAIL']) || isset($supplier['Supplier']['CONTACT4_PHONE']) || isset($supplier['Supplier']['CONTACT4_FUNCTION'])) {
                    echo '<tr>';
                    ?>
                    <td style="font-weight: bolder;">Contact person 4:</td>
                    <td><?php echo $supplier['Supplier']['CONTACT4_NAME']; ?></td>
                    <td><?php echo $this->Text->autoLinkEmails($supplier['Supplier']['CONTACT4_EMAIL']); ?></td>
                    <td><?php echo $supplier['Supplier']['CONTACT4_PHONE']; ?></td>
                    <td><?php echo $supplier['Supplier']['CONTACT4_FUNCTION']; ?></td>
                    <?php
                }
                echo '</tr>';
                if (isset($supplier['Supplier']['CONTACT5_NAME']) || isset($supplier['Supplier']['CONTACT5_EMAIL']) || isset($supplier['Supplier']['CONTACT5_PHONE']) || isset($supplier['Supplier']['CONTACT5_FUNCTION'])) {
                    echo '<tr>';
                    ?>
                    <td style="font-weight: bolder;">Contact person 5:</td>
                    <td><?php echo $supplier['Supplier']['CONTACT5_NAME']; ?></td>
                    <td><?php echo $this->Text->autoLinkEmails($supplier['Supplier']['CONTACT5_EMAIL']); ?></td>
                    <td><?php echo $supplier['Supplier']['CONTACT5_PHONE']; ?></td>
                    <td><?php echo $supplier['Supplier']['CONTACT5_FUNCTION']; ?></td>
                    <?php
                }
                echo '</tr>';
                if (isset($supplier['Supplier']['CONTACT6_NAME']) || isset($supplier['Supplier']['CONTACT6_EMAIL']) || isset($supplier['Supplier']['CONTACT6_PHONE']) || isset($supplier['Supplier']['CONTACT6_FUNCTION'])) {
                    echo '<tr>';
                    ?>
                    <td style="font-weight: bolder;">Contact person 6:</td>
                    <td><?php echo $supplier['Supplier']['CONTACT6_NAME']; ?></td>
                    <td><?php echo $this->Text->autoLinkEmails($supplier['Supplier']['CONTACT6_EMAIL']); ?></td>
                    <td><?php echo $supplier['Supplier']['CONTACT6_PHONE']; ?></td>
                    <td><?php echo $supplier['Supplier']['CONTACT6_FUNCTION']; ?></td>
    <?php
}
echo '</tr>';
?>
            </table>
        </td></tr>
</table>

<table class="sup_bsci">
    <label style="font-weight: bolder; color: darkblue;">CSR BSCI</label>
    <tr>
        <td>Participation required:</td>
        <td><?php echo $supplier['Supplier']['BSCI_PART']; ?></td>
        <td>Audit result:</td>
        <td><?php echo $supplier['Supplier']['BSCI_RESULT']; ?></td>
        <td>Auditcycle valid from:</td>
        <td><?php echo $supplier['Supplier']['BSCI_FROM']; ?></td>
        <td>Valid till:</td>
        <td><?php echo $supplier['Supplier']['BSCI_TILL']; ?></td>
    </tr>
<?php if (isset($supplier['Supplier']['BSCI_OTHER1_NAME']) && $supplier['Supplier']['BSCI_OTHER1_NAME'] != '-') {
    echo '<tr>';
    ?>
        <td>Other participations 1:</td>
        <td colspan="3"><?php echo $supplier['Supplier']['BSCI_OTHER1_NAME']; ?></td>
        <td>Valid from:</td>
        <td><?php echo $supplier['Supplier']['BSCI_OTHER1_FROM']; ?></td>
        <td>Valid till:</td>
        <td><?php echo $supplier['Supplier']['BSCI_OTHER1_TILL']; ?></td>
        <?php
        echo '</tr>';
    }
    if (isset($supplier['Supplier']['BSCI_OTHER2_NAME']) && $supplier['Supplier']['BSCI_OTHER2_NAME'] != '-') {
        echo '<tr>';
        ?>
        <td>Other participations 2:</td>
        <td colspan="3"><?php echo $supplier['Supplier']['BSCI_OTHER2_NAME']; ?></td>
        <td>Valid from:</td>
        <td><?php echo $supplier['Supplier']['BSCI_OTHER2_FROM']; ?></td>
        <td>Valid till:</td>
        <td><?php echo $supplier['Supplier']['BSCI_OTHER2_TILL']; ?></td>
    <?php
    echo '</tr>';
}
if (isset($supplier['Supplier']['BSCI_OTHER3_NAME']) && $supplier['Supplier']['BSCI_OTHER3_NAME'] != '-') {
    echo '<tr>';
    ?>
        <td>Other participations 3:</td>
        <td colspan="3"><?php echo $supplier['Supplier']['BSCI_OTHER3_NAME']; ?></td>
        <td>Valid from:</td>
        <td><?php echo $supplier['Supplier']['BSCI_OTHER3_FROM']; ?></td>
        <td>Valid till:</td>
        <td><?php echo $supplier['Supplier']['BSCI_OTHER3_TILL']; ?></td>
    <?php
    echo '</tr>';
    } ?>
</table>
<table style="width: auto;"><td style="vertical-align: auto;">
<table class="sup_cert">
    <label style="font-weight: bolder; color: darkgreen;">Certification</label>
    <tr>
        <th style="border-bottom: none;"></th>
        <th>Valid from</th>
        <th>Valid till</th>
        <th>Auditing company</th>
    </tr>
    <tr>
        <td style="font-weight: bold;"><?php echo $supplier['Supplier']['CERT_ISO9000']; ?></td>
        <td><?php echo $supplier['Supplier']['CERT_ISO9000_FROM']; ?></td>
        <td><?php echo $supplier['Supplier']['CERT_ISO9000_TILL']; ?></td>
        <td><?php echo $supplier['Supplier']['CERT_ISO9000_NAME']; ?></td>
    </tr>
    <?php if (isset($supplier['Supplier']['CERT_ISO14000'])){?>
    <tr>
        <td style="font-weight: bold;"><?php echo $supplier['Supplier']['CERT_ISO14000']; ?></td>
        <td><?php echo $supplier['Supplier']['CERT_ISO14000_FROM']; ?></td>
        <td><?php echo $supplier['Supplier']['CERT_ISO14000_TILL']; ?></td>
        <td><?php echo $supplier['Supplier']['CERT_ISO14000_NAME']; ?></td>
    </tr>
    <?php }
    if (isset($supplier['Supplier']['CERT_OTHER1'])){?>
    <tr>
        <td style="font-weight: bold;"><?php echo $supplier['Supplier']['CERT_OTHER1']; ?></td>
        <td><?php echo $supplier['Supplier']['CERT_OTHER1_FROM']; ?></td>
        <td><?php echo $supplier['Supplier']['CERT_OTHER1_TILL']; ?></td>
        <td><?php echo $supplier['Supplier']['CERT_OTHER1_NAME']; ?></td>
    </tr>
    <?php }
    if (isset($supplier['Supplier']['CERT_OTHER2'])){?>
    <tr>
        <td style="font-weight: bold;"><?php echo $supplier['Supplier']['CERT_OTHER2']; ?></td>
        <td><?php echo $supplier['Supplier']['CERT_OTHER2_FROM']; ?></td>
        <td><?php echo $supplier['Supplier']['CERT_OTHER2_TILL']; ?></td>
        <td><?php echo $supplier['Supplier']['CERT_OTHER2_NAME']; ?></td>
    </tr>
    <?php }
    if (isset($supplier['Supplier']['CERT_OTHER3'])){?>
    <tr>
        <td style="font-weight: bold;"><?php echo $supplier['Supplier']['CERT_OTHER3']; ?></td>
        <td><?php echo $supplier['Supplier']['CERT_OTHER3_FROM']; ?></td>
        <td><?php echo $supplier['Supplier']['CERT_OTHER3_TILL']; ?></td>
        <td><?php echo $supplier['Supplier']['CERT_OTHER3_NAME']; ?></td>
    </tr>
    <?php }
    if (isset($supplier['Supplier']['CERT_OTHER4'])){?>
    <tr>
        <td style="font-weight: bold;"><?php echo $supplier['Supplier']['CERT_OTHER4']; ?></td>
        <td><?php echo $supplier['Supplier']['CERT_OTHER4_FROM']; ?></td>
        <td><?php echo $supplier['Supplier']['CERT_OTHER4_TILL']; ?></td>
        <td><?php echo $supplier['Supplier']['CERT_OTHER4_NAME']; ?></td>
    </tr>
    <?php }
    if (isset($supplier['Supplier']['CERT_OTHER5'])){?>
    <tr>
        <td style="font-weight: bold;"><?php echo $supplier['Supplier']['CERT_OTHER5']; ?></td>
        <td><?php echo $supplier['Supplier']['CERT_OTHER5_FROM']; ?></td>
        <td><?php echo $supplier['Supplier']['CERT_OTHER5_TILL']; ?></td>
        <td><?php echo $supplier['Supplier']['CERT_OTHER5_NAME']; ?></td>
    </tr>
    <?php }
    if (isset($supplier['Supplier']['CERT_OTHER6'])){?>
    <tr>
        <td style="font-weight: bold;"><?php echo $supplier['Supplier']['CERT_OTHER6']; ?></td>
        <td><?php echo $supplier['Supplier']['CERT_OTHER6_FROM']; ?></td>
        <td><?php echo $supplier['Supplier']['CERT_OTHER6_TILL']; ?></td>
        <td><?php echo $supplier['Supplier']['CERT_OTHER6_NAME']; ?></td>
    </tr>
    <?php }
    if (isset($supplier['Supplier']['CERT_OTHER7'])){?>
    <tr>
        <td style="font-weight: bold;"><?php echo $supplier['Supplier']['CERT_OTHER7']; ?></td>
        <td><?php echo $supplier['Supplier']['CERT_OTHER7_FROM']; ?></td>
        <td><?php echo $supplier['Supplier']['CERT_OTHER7_TILL']; ?></td>
        <td><?php echo $supplier['Supplier']['CERT_OTHER7_NAME']; ?></td>
    </tr>
    <?php }
    if (isset($supplier['Supplier']['CERT_OTHER8'])){?>
    <tr>
        <td style="font-weight: bold;"><?php echo $supplier['Supplier']['CERT_OTHER8']; ?></td>
        <td><?php echo $supplier['Supplier']['CERT_OTHER8_FROM']; ?></td>
        <td><?php echo $supplier['Supplier']['CERT_OTHER8_TILL']; ?></td>
        <td><?php echo $supplier['Supplier']['CERT_OTHER8_NAME']; ?></td>
    </tr>
    <?php }
    if (isset($supplier['Supplier']['CERT_OTHER9'])){?>
    <tr>
        <td style="font-weight: bold;"><?php echo $supplier['Supplier']['CERT_OTHER9']; ?></td>
        <td><?php echo $supplier['Supplier']['CERT_OTHER9_FROM']; ?></td>
        <td><?php echo $supplier['Supplier']['CERT_OTHER9_TILL']; ?></td>
        <td><?php echo $supplier['Supplier']['CERT_OTHER9_NAME']; ?></td>
    </tr>
    <?php }
    if (isset($supplier['Supplier']['CERT_OTHER10'])){?>
    <tr>
        <td style="font-weight: bold;"><?php echo $supplier['Supplier']['CERT_OTHER10']; ?></td>
        <td><?php echo $supplier['Supplier']['CERT_OTHER10_FROM']; ?></td>
        <td><?php echo $supplier['Supplier']['CERT_OTHER10_TILL']; ?></td>
        <td><?php echo $supplier['Supplier']['CERT_OTHER10_NAME']; ?></td>
    </tr>
    <?php }?>    
</table>
</td><td style="vertical-align: auto; padding-left: 20px;">
<table class="sup_decl">
    <label style="font-weight: bolder; color: darkblue;">Declaration<span><?php if (isset($supplier['Supplier']['DECL_PAY'])){echo 'Payments: ' . $supplier['Supplier']['DECL_PAY'];}?></span></label>
    <tr>
        <th>Received</th>
        <th>Date signed</th>
    </tr>
    <tr>
        <?php
        if ($supplier['Supplier']['DECL_BRAND'] == 1) {?>
            <td>Brand authorization</td><td><?php echo $supplier['Supplier']['DECL_BRAND_DATE']; ?></td>
        <?php }?>
    </tr>
    <tr>
        <?php
        if ($supplier['Supplier']['DECL_SDA'] == 1) {
            echo '<td>SDA</td><td>' . $supplier['Supplier']['DECL_SDA_DATE'] . '</td>';
        }
        ?>
    </tr>
    <tr>
        <?php
        if ($supplier['Supplier']['DECL_PACK'] == 1) {
            echo '<td>Packaging & Packaging waste</td><td>' . $supplier['Supplier']['DECL_PACK_DATE'] . '</td>';
        }
        ?>
    </tr>
    <tr>
        <?php
        if ($supplier['Supplier']['DECL_SOP'] == 1) {
            echo '<td>SOP</td><td>' . $supplier['Supplier']['DECL_SOP_DATE'] . '</td>';
        }
        ?>
    </tr>
    <tr>
        <?php
        if ($supplier['Supplier']['DECL_CONTR'] == 1) {
            echo '<td>Confidentiality agreement</td><td>' . $supplier['Supplier']['DECL_CONTR_DATE'] . '</td>';
        }
        ?>
    </tr>
    <tr>
        <?php
        if ($supplier['Supplier']['DECL_REACH'] == 1) {
            echo '<td>REACH</td><td>' . $supplier['Supplier']['DECL_REACH_DATE'] . '</td>';
        }
        ?>
    </tr>
    <tr>
        <?php
        if ($supplier['Supplier']['DECL_ROHS'] == 1) {
            echo '<td>RoHS</td><td>' . $supplier['Supplier']['DECL_ROHS_DATE'] . '</td>';
        }
        ?>
    </tr>
</table>
</td>
<?php if (strlen($supplier['Supplier']['DECL_WARRANTY'])>0) {
            echo '<td style="vertical-align: auto; padding-left: 20px;font-weight: bold; color: darkblue;">Warranty agreement:</br>' . $this->Form->textarea('DECL_WARRANTY', array('rows' => '7', 'cols' => '70')) .'</td>';
        }
?>
</table>
<?php
$supplierMainDirectory = "G" . DS . "S&L_Data" . DS . "QC" . DS . "Suppliers" . DS . "Asia" . DS;
if (isset($supplier['Supplier']['FOLDER']) && file_exists('img' . DS . $supplierMainDirectory . $supplier['Supplier']['FOLDER'])) {
    echo $this->Html->link('Folder', array('controller' => 'img' . DS . $supplierMainDirectory . $supplier['Supplier']['FOLDER']), array('target' => '_blank', 'class' => 'button'));
}
if ($this->Session->read('Auth.User') && AuthComponent::user('group') ==0) {
    echo $this->Html->link('Edit', array('action' => 'sedit', $supplier['Supplier']['id']), array('class' => 'button'));
}
?>