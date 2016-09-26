<h2 style="text-align: center;color: blue;"><?php echo 'Search for standard: <i>'.$_GET["filters"].'</i>' ?></h2>
<?php
echo $this->Form->create(null, array('type' => 'get'));
echo 'Enter the standard you looking for and click ENTER:</br>';
echo '<span><u><i>'. $this->Paginator->counter(array('format' => __('found {:count} items'))).'</i></u></span>'.$this->Form->input('filters', array('label'=>false,'type' => 'text')); 
echo $this->Form->end();
?>
<table class="index">
        <th><?php echo $this->Paginator->sort('QM_STATUS', 'QC status');?></th>
        <th><?php echo $this->Paginator->sort('ITEM', 'Item') ?></th>
        <th><?php echo $this->Paginator->sort('SAP', 'SAP') ?></th>
        <th><?php echo $this->Paginator->sort('DESCR_EN', 'Description') ?></th>
        <th><?php echo $this->Paginator->sort('EAN', 'EAN') ?></th>
        <th><?php echo $this->Paginator->sort('BRAND', 'Brand') ?></th>
        <th><?php echo $this->Paginator->sort('VENDOR', 'Supplier Nr and Name') ?></th>
        <th><?php echo $this->Paginator->sort('ITEM_S', 'Supplier Item Nr according to certificates') ?></th>
        <th><?php echo $this->Paginator->sort('ITEM_S_SAP', 'Supplier Item Nr according to SAP') ?></th>
        <th><?php echo $this->Paginator->sort('STATUS', 'SAP Status') ?></th>
        <th><?php echo $this->Paginator->sort('VALID_DATE', 'Valid in SAP since') ?></th>
    <?php foreach ($items as $item): ?>
        <tr>
            <?php
            $sapWithoutDots = str_replace(".", "", $item['Item']['SAP']);
            $directory = "X" . DS . "Smartwares - Product Content" . DS . "PRODUCTS" . DS . $sapWithoutDots . DS;
            $imgFile2 = $directory . "LR_" . $sapWithoutDots . "_2.jpg";
            $imgFile3 = $directory . "LR_" . $sapWithoutDots . "_3.jpg";
            $imgFile10 = $directory . "LR_" . $sapWithoutDots . "_10.jpg";
            $imgFile4 = $directory . "LR_" . $sapWithoutDots . "_4.jpg";
            if (file_exists(WWW_ROOT . 'img' . DS . $imgFile2)) {
                $imgFile = $imgFile2;
            } elseif (file_exists(WWW_ROOT . 'img' . DS . $imgFile3)) {
                $imgFile = $imgFile3;
            } elseif (file_exists(WWW_ROOT . 'img' . DS . $imgFile10)) {
                $imgFile = $imgFile10;
            } else {
                $imgFile = $imgFile4;
            }
            if ($this->Session->read('Auth.User')) { ?>
                <td>
                <div style="display:none;"><?php echo $item['Item']['QM_STATUS']; ?> </div>
                <div style="display:none;"><?php echo $item['Item']['QC_STATUS']; ?> </div>
                <svg height="24" width="24">
                     <circle cx="12" cy="12" r="12" stroke="black" stroke-width="0" fill="<?php echo  $item['Item']['QM_STATUS']; ?>" />
                     <?php if ($item['Item']['ADAPTOR1']==1){
                     echo '<circle cx="12" cy="12" r="5" stroke="black" stroke-width="1" fill="' . $item['Item']['QC_STATUS'] . '" />';
                     } ?>
                     <?php 
                    if (isset($item['Item']['QC_STATUS'])) {
                        if ($item['Item']['QM_STATUS'] == 'GREEN' && $item['Item']['QC_STATUS'] == 'GREEN') {
                            $kolor = 'GREEN';
                        } else {
                            $kolor = 'RED';
                        }
                    } else {
                        if ($item['Item']['QM_STATUS']=='GREEN'){
                            $kolor = 'GREEN';
                        } else {
                            $kolor = 'RED';
                        }
                    }
                    ?>
                     <text x="23" y="5" font-family="sans-serif" font-size="10px" fill="<?php echo $kolor;?>"><?php echo $item['Item']['QM_STATUS'] .
                             (isset($item['Item']['QC_STATUS']) ? ' (adaptor: ' . $item['Item']['QC_STATUS'] . ')' : null);?>
                     </text>
                </svg>
                </td>
            <?php }?>
            <td><?php echo $this->Html->link($item['Item']['ITEM'] . '<span>' . $this->Html->image($imgFile, array('class' => 'callout', 'onerror'=>'this.style.display = "none"')) . '</span>', array('controller' => 'items', 'action' => 'view', $item['Item']['id']), array('escape' => false, 'target' => '_blank')); ?></td>
            <td><?php echo $this->Html->link($item['Item']['SAP'] . '<span>' . $this->Html->image($imgFile, array('class' => 'callout', 'onerror'=>'this.style.display = "none"')) . '</span>', array('controller' => 'items', 'action' => 'view', $item['Item']['id']), array('escape' => false, 'target' => '_blank')); ?></td>
            <td><?php echo $item['Item']['DESCR_EN']; ?></td>
            <td><?php echo $item['Item']['EAN']; ?></td>
            <td><?php echo $item['Item']['BRAND']; ?></td>
            <?php
            if ($this->Session->read('Auth.User')) {
                echo '<td>';
                echo $item['Item']['VENDOR'] . '</br>';
                echo $item['Item']['SUPPLIER'];
                echo '</td><td>';
                echo $item['Item']['ITEM_S'];
                if ($item['Item']['ITEM_S']!=$item['Item']['ITEM_S_SAP']){$color='red';} else{$color='black';}
                echo '</td><td style=color:'.$color.';>';
                echo $item['Item']['ITEM_S_SAP'];
                echo '</td>';
            }
            ?>
            <td><?php echo $item['Item']['STATUS']; ?></td>
            <td><?php echo $item['Item']['VALID_DATE']; ?></td>
        </tr>
    <?php endforeach; ?>
</table>
