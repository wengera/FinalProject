<?php
/**
 * Author: Louie Zhu
 * Date: Mar 6, 2016
 * Name: error.php
 * Description: this script displays an error message. This script is globally available throughout the application. 
 *     The message to be displayed is passed to this script via variable $message. The dispatcher uses this to 
 *     display an error message when the requested controller is not found.
 */

$page_title = "Error";
//display header
IndexView::displayHeader($page_title);

?>
<div id = "main-header">Error</div>
<hr>
<table style = "width: 100%; border: none">
    <tr>
        <td style = "text-align: left; vertical-align: top;">
            <h3 style = "color: white"> Sorry, but an error has occurred.</h3>
            <div style = "color: white">
                <?= urldecode($message)
                ?>
            </div>
            <br>
        </td>
    </tr>
</table>

<?php
//display footer
IndexView::displayFooter();
