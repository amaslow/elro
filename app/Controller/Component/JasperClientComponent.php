<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of JaperClientComponent
 *
 * @author Harindra
 */
App::uses('Component', 'Controller');

class JasperClientComponent extends Component {

//put your code here
    private $client;

    public function initialize(Controller $controller) {
        parent::initialize($controller);
        App::import('Vendor', 'JasperReports.Client'
                , array('file' => 'JasperClient/client.php'));

        if (!class_exists('JasperWSClient')) {
            die('Jasper interface class not found');
        } else {
            $this->client = new JasperWSClient();
        }
    }

    public function runReport($reportURI) {

        $currentUri = $reportURI;

        $result = $this->client->ws_get($currentUri);
        if (is_soap_fault($result)) {
            $errorMessage = $result->getFault()->faultstring;
            echo $errorMessage;
            exit();
        } else {
            $folders = $this->client->getResourceDescriptors($result);
        }

        if (count($folders) != 1 || $folders[0]['type'] != 'reportUnit') {
            echo "<H1>Invalid RU ($currentUri)</H1>";
            echo "<pre>$result</pre>";
            exit();
        }

        $reportUnit = $folders[0];
        return $reportUnit;
    }

    public function executeReport() {
        /*
         * Adapted from jasper php client example
         */

        // 1 Get the ReoportUnit ResourceDescriptor...
        $currentUri = "/";

        if ($_GET['uri'] != '') {
            $currentUri = $_GET['uri'];
        }
        echo "Current URI is " . $currentUri;

        $result = $this->client->ws_get($currentUri);

        if (is_soap_fault($result)) {
            $errorMessage = $result->getFault()->faultstring;

            echo $errorMessage;
            exit();
        } else {
            $folders = $this->client->getResourceDescriptors($result);
        }

        if (count($folders) != 1 || $folders[0]['type'] != 'reportUnit') {
            echo "<H1>Invalid RU ($currentUri)</H1>";
            echo "<pre>$result</pre>";
            exit();
        }

        $reportUnit = $folders[0];

        // 2. Prepare the parameters array looking in the $_GET for
        // params
        // starting with PARAM_ ...
        //

        $report_params = array();
        $report_params['department'] = 1;

        // 3. Execute the report
        $output_params = array();
        $output_params[RUN_OUTPUT_FORMAT] = 'PDF';
        $result = $this->client->ws_runReport($currentUri, $report_params, $output_params, $attachments);
// 4.
        if (is_soap_fault($result)) {
            $errorMessage = $result->getFault()->faultstring;

            echo $errorMessage;
            exit();
        }
        $operationResult = $this->client->getOperationResult
                ($result);

        if ($operationResult['returnCode'] != '0') {
            echo "Error executing the report:<br><font color=\"red
\">" . $operationResult['returnMessage'] . "</font>";
            exit();
        }

        if (is_array($attachments)) {
            header("Content-type: application/pdf");
            echo( $attachments["cid:report"]);
        }
        else
            echo "No attachment found!";
    }

}
?>
