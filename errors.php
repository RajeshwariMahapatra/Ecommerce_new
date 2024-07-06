<?php

function checkerror($errorcode){
    
        $errorstatus = '';

        switch ($errorcode) {
            case '101':
                $errorstatus='Please enter the product name';
                break;
            case '102':
                $errorstatus='Please enter the product description';
                break;
            case '103':
                $errorstatus='Please enter the product small description';
                break;
            case '104':
                $errorstatus='Please enter the product stock';
                break;
            case '105':
                $errorstatus='Please enter the product MRP';
                break;
            case '106':
                $errorstatus='Please enter the product selling price';
                break;
            case '107':
                $errorstatus='Selling price must be less than MRP';
                break;
            case '108':
                $errorstatus='Please enter the estimated shipping time';
                break;
            case '109':
                $errorstatus='Please enter the product tax percentage';
                break;
            case '110':
                $errorstatus='Please enter the product HSN Code';
                break;
            case '111':
                $errorstatus='Please enter the product certification';
                break;
            case '112':
                $errorstatus='Please enter the product SKU';
                break;
            case '113':
                $errorstatus='Please enter the product code';
                break;
                
            default:
                $errorstatus='Unknown error';
                break;
        }

        return $errorstatus;

}
?>