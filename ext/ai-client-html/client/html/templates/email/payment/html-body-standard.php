<?php

/**
 * @license LGPLv3, http://opensource.org/licenses/LGPL-3.0
 * @copyright Aimeos (aimeos.org), 2019-2021
 */

/** Available data
 * - summaryBasket : Order base item (basket) with addresses, services, products, etc.
 * - summaryTaxRates : List of tax values grouped by tax rates
 * - summaryNamedTaxes : Calculated taxes grouped by the tax names
 * - summaryShowDownloadAttributes : True if product download links should be shown, false if not
 * - summaryCostsDelivery : Sum of all shipping costs
 * - summaryCostsPayment : Sum of all payment costs
 */


$enc = $this->encoder();


?>
<?php $this->block()->start( 'email/payment/html' ) ?>
<?php foreach( $this->summaryBasket->getAddress( 'payment' ) as $addr ) : ?>
    <style type="text/css">
        table, td { color: #000000; } @media only screen and (min-width: 620px) {
            .u-row {
                width: 600px !important;
            }
            .u-row .u-col {
                vertical-align: top;
            }

            .u-row .u-col-33p33 {
                width: 199.98px !important;
            }

            .u-row .u-col-50 {
                width: 300px !important;
            }

            .u-row .u-col-66p67 {
                width: 400.02px !important;
            }

            .u-row .u-col-100 {
                width: 600px !important;
            }

        }

        @media (max-width: 620px) {
            .u-row-container {
                max-width: 100% !important;
                padding-left: 0px !important;
                padding-right: 0px !important;
            }
            .u-row .u-col {
                min-width: 320px !important;
                max-width: 100% !important;
                display: block !important;
            }
            .u-row {
                width: calc(100% - 40px) !important;
            }
            .u-col {
                width: 100% !important;
            }
            .u-col > div {
                margin: 0 auto;
            }
        }
        body {
            margin: 0;
            padding: 0;
        }

        table,
        tr,
        td {
            vertical-align: top;
            border-collapse: collapse;
        }

        p {
            margin: 0;
        }

        .ie-container table,
        .mso-container table {
            table-layout: fixed;
        }

        * {
            line-height: inherit;
        }

        a[x-apple-data-detectors='true'] {
            color: inherit !important;
            text-decoration: none !important;
        }

    </style>

<table style="border-collapse: collapse;table-layout: fixed;border-spacing: 0;mso-table-lspace: 0pt;mso-table-rspace: 0pt;vertical-align: top;min-width: 320px;Margin: 0 auto;background-color: #707070;width:100%" cellpadding="0" cellspacing="0">
    <tbody>
    <tr style="vertical-align: top">
        <td style="word-break: break-word;border-collapse: collapse !important;vertical-align: top">
            <table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td align="center" style="background-color: #707070;">


                        <table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="padding: 29px 10px 0px;background-color: rgba(255,255,255,0);" align="center"><table cellpadding="0" cellspacing="0" border="0" style="width:600px;"><tr style="background-color: #17c297;">

                        <td align="center" width="200" style="width: 200px;padding: 0px;border-top: 0px solid transparent;border-left: 0px solid transparent;border-right: 0px solid transparent;border-bottom: 0px solid transparent;" valign="top">
                        <div class="u-col u-col-33p33" style="max-width: 320px;min-width: 200px;display: table-cell;vertical-align: top;">
                            <div style="width: 100% !important;">
                                <div style="padding: 0px;border-top: 0px solid transparent;border-left: 0px solid transparent;border-right: 0px solid transparent;border-bottom: 0px solid transparent;">

                                    <table style="font-family:'Lato',sans-serif;" role="presentation" cellpadding="0" cellspacing="0" width="100%" border="0">
                                        <tbody>
                                        <tr>
                                            <td style="overflow-wrap:break-word;word-break:break-word;padding:20px;font-family:'Lato',sans-serif;" align="left">

                                                <table width="100%" cellpadding="0" cellspacing="0" border="0">
                                                    <tr>
                                                        <td style="padding-right: 0px;padding-left: 0px;" align="center">

                                                            <img align="center" border="0" src="<?php echo asset("images/logo.jpg") ?>" alt="Image" title="Image" style="outline: none;text-decoration: none;-ms-interpolation-mode: bicubic;clear: both;display: inline-block !important;border: none;height: auto;float: none;width: 100%;max-width: 160px;" width="160"/>

                                                        </td>
                                                    </tr>
                                                </table>

                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>

                            </div>
                        </div>

                        <td align="center" width="400" style="width: 400px;padding: 0px;border-top: 0px solid transparent;border-left: 0px solid transparent;border-right: 0px solid transparent;border-bottom: 0px solid transparent;" valign="top">
                        <div class="u-col u-col-66p67" style="max-width: 320px;min-width: 400px;display: table-cell;vertical-align: top;">
                            <div style="width: 100% !important;">
                               <div style="padding: 0px;border-top: 0px solid transparent;border-left: 0px solid transparent;border-right: 0px solid transparent;border-bottom: 0px solid transparent;">

                                    <table style="font-family:'Lato',sans-serif;" role="presentation" cellpadding="0" cellspacing="0" width="100%" border="0">
                                        <tbody>
                                        <tr>
                                            <td style="overflow-wrap:break-word;word-break:break-word;padding:44px 20px 20px;font-family:'Lato',sans-serif;" align="left">

                                                <div style="color: #ffffff; line-height: 120%; text-align: right; word-wrap: break-word;">
                                                    <p style="font-size: 14px; line-height: 120%;">If you can't view this invoice properly please use web view.</p>
                                                </div>

                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>

                            </div>
                        </div>





                        <table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="padding: 0px 10px;background-color: rgba(255,255,255,0);" align="center"><table cellpadding="0" cellspacing="0" border="0" style="width:600px;"><tr style="background-color: #f5f5f5;">


                        <div class="u-col u-col-50" style="max-width: 320px;min-width: 300px;display: table-cell;vertical-align: top;">
                            <div style="width: 100% !important;">
                                <div style="padding: 0px;border-top: 0px solid transparent;border-left: 0px solid transparent;border-right: 0px solid transparent;border-bottom: 0px solid transparent;"><!--<![endif]-->

                                    <table style="font-family:'Lato',sans-serif;" role="presentation" cellpadding="0" cellspacing="0" width="100%" border="0">
                                        <tbody>
                                        <tr>
                                            <td style="overflow-wrap:break-word;word-break:break-word;padding:35px 20px 10px;font-family:'Lato',sans-serif;" align="left">

                                                <div style="line-height: 120%; text-align: left; word-wrap: break-word;">
                                                    <p style="font-size: 14px; line-height: 120%;"><span style="font-size: 24px; line-height: 28.8px; color: #18c197;"><strong>Shipping Address</strong></span></p>
                                                </div>

                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>

                                    <table style="font-family:'Lato',sans-serif;" role="presentation" cellpadding="0" cellspacing="0" width="100%" border="0">
                                        <tbody>
                                        <tr>
                                            <td style="overflow-wrap:break-word;word-break:break-word;padding:10px 20px 30px;font-family:'Lato',sans-serif;" align="left">

                                                <div style="color: #757575; line-height: 160%; text-align: left; word-wrap: break-word;">
                                                    <p style="font-size: 14px; line-height: 160%;"><span style="font-size: 14px; line-height: 22.4px;"><?= $addr->getAddress1() ?></span></p>
                                                    <p style="font-size: 14px; line-height: 160%;"><span style="font-size: 14px; line-height: 22.4px;"><?= $addr->getAddress2() ?></span></p>
                                                    <p style="font-size: 14px; line-height: 160%;">
                                                        <span style="font-size: 14px; line-height: 22.4px;">
                                                            <?= $addr->getCity() . ' ' . $addr->getState() ?>
                                                        </span>
                                                    </p>
                                                </div>

                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>

                            </div>
                        </div>

                        <td align="center" width="300" style="width: 300px;padding: 0px;border-top: 0px solid transparent;border-left: 0px solid transparent;border-right: 0px solid transparent;border-bottom: 0px solid transparent;" valign="top">
                        <div class="u-col u-col-50" style="max-width: 320px;min-width: 300px;display: table-cell;vertical-align: top;">
                            <div style="width: 100% !important;">
                                <div style="padding: 0px;border-top: 0px solid transparent;border-left: 0px solid transparent;border-right: 0px solid transparent;border-bottom: 0px solid transparent;">

                                    <table style="font-family:'Lato',sans-serif;" role="presentation" cellpadding="0" cellspacing="0" width="100%" border="0">
                                        <tbody>
                                        <tr>
                                            <td style="overflow-wrap:break-word;word-break:break-word;padding:35px 20px 10px;font-family:'Lato',sans-serif;" align="left">

                                                <div style="color: #333333; line-height: 120%; text-align: left; word-wrap: break-word;">
                                                    <p style="font-size: 14px; line-height: 120%;"><strong><span style="font-size: 24px; line-height: 28.8px;">Invoice Number</span></strong></p>
                                                </div>

                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>

                                    <table style="font-family:'Lato',sans-serif;" role="presentation" cellpadding="0" cellspacing="0" width="100%" border="0">
                                        <tbody>
                                        <tr>
                                            <td style="overflow-wrap:break-word;word-break:break-word;padding:10px 20px 30px;font-family:'Lato',sans-serif;" align="left">

                                                <div style="color: #333333; line-height: 120%; text-align: left; word-wrap: break-word;">
                                                    <p style="font-size: 14px; line-height: 120%;"><span style="font-size: 20px; line-height: 24px;"><strong>#9878748</strong></span></p>
                                                </div>

                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>

                                    <table>
                                        <tbody>
                                        <?php foreach( $this->summaryBasket->getProducts() as $product ) : ?>
                                            <tr>
                                                <td><?= $product->getName() ?></td>
                                                <td><?= $this->summaryBasket->getPrice()->getValue() ?></td>
                                            </tr>
                                        <?php endforeach; ?>
                                        </tbody>

                                    </table>

                            </div>
                        </div>

</table>

<?php endforeach; ?>
<?php $this->block()->stop() ?>
<?= $this->block()->get( 'email/payment/html' ) ?>
