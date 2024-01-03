<link rel="stylesheet" href="./public/assets/css/order.css" />


<?php
    $id = $_GET['id'];

    $orderId = str_pad($id, 6, '0', STR_PAD_LEFT);

    $sql_order = "SELECT * FROM orders, users WHERE ORDER_ID = $id and orders.USER_PHONE = users.USER_PHONE ";
    $result_order = mysqli_query($connect, $sql_order);
    $row_order = mysqli_fetch_assoc($result_order);

    $sql_detail = "SELECT sum(order_detail_quantity) as `sosp` FROM order_details, orders WHERE orders.ORDER_ID = order_details.ORDER_ID and orders.ORDER_ID = $id";
    $result_detail = mysqli_query($connect, $sql_detail);
    $row_detail = mysqli_fetch_assoc($result_detail);

    if ($row_order['ORDER_SHIPPING'] == 0)
        $shipping = "Tại cửa hàng (Đường Hàn Thuyên, khu phố 6, phường Linh Trung, TP.Thủ Đức, TP.Hồ Chí Minh)";
    else if ($row_order['ORDER_SHIPPING'] == 1)
        $shipping = $row_order['USER_ADDRESS'];
?>

<section >
    <div style="display: none; font-size: 1px; color: #fefefe; line-height: 1px; max-height: 0px; max-width: 0px; opacity: 0; overflow: hidden;">
    </div>

    <table border="0" cellpadding="0" cellspacing="0" width="100%">
        <tr>
            <td align="center" style="background-color: #eeeeee;" bgcolor="#eeeeee">
                <table align="center" border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width:600px;">
                    <tr>
                        <td align="center" style="padding: 0 35px 20px 35px; background-color: #ffffff;" bgcolor="#ffffff">
                            <table align="center" border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width:600px;">
                                <tr>
                                    <td align="center" style="font-size: 16px; font-weight: 400; line-height: 24px; padding-top: 25px;">
                                        <img src="https://img.icons8.com/carbon-copy/100/000000/checked-checkbox.png" width="125" height="120" style="display: block; border: 0px;" /><br>
                                        <h2 style="font-size: 30px; font-weight: 800; line-height: 36px; color: #333333; margin: 0;">
                                            Bạn đã đặt hàng thành công!
                                        </h2>
                                    </td>
                                </tr>
                                <tr>
                                    <td align="left" style="padding-top: 20px;">
                                        <table cellspacing="0" cellpadding="0" border="0" width="100%">
                                            <tr>
                                                <td width="75%" align="left" bgcolor="#eeeeee" style="font-size: 16px; font-weight: 800; line-height: 24px; padding: 10px;">
                                                    Mã đơn hàng
                                                </td>
                                                <td width="25%" align="left" bgcolor="#eeeeee" style="font-size: 16px; font-weight: 800; line-height: 24px; padding: 10px;">
                                                    #<?php echo $orderId; ?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td width="75%" align="left" style="font-size: 16px; font-weight: 400; line-height: 24px; padding: 15px 10px 5px 10px;">
                                                    Sản phẩm (<?php echo $row_detail['sosp']; ?>)
                                                </td>
                                                <td width="25%" align="left" style="font-size: 16px; font-weight: 400; line-height: 24px; padding: 15px 10px 5px 10px;">
                                                    <?php echo number_format($row_order['ORDER_TOTAL'], 0, ',', '.');?> đ
                                                </td>
                                            </tr>
                                            <tr>
                                                <td width="75%" align="left" style="font-size: 16px; font-weight: 400; line-height: 24px; padding: 5px 10px;">
                                                    Phí vận chuyển
                                                </td>
                                                <td width="25%" align="left" style="font-size: 16px; font-weight: 400; line-height: 24px; padding: 5px 10px;">
                                                    0 đ
                                                </td>
                                            </tr>
                                            <tr>
                                                <td width="75%" align="left" style=" font-size: 16px; font-weight: 400; line-height: 24px; padding: 5px 10px;">
                                                    Khuyến mãi
                                                </td>
                                                <td width="25%" align="left" style="font-size: 16px; font-weight: 400; line-height: 24px; padding: 5px 10px;">
                                                    0 đ
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                                <tr>
                                    <td align="left" style="padding-top: 20px;">
                                        <table cellspacing="0" cellpadding="0" border="0" width="100%">
                                            <tr>
                                                <td width="75%" align="left" style="font-size: 16px; font-weight: 800; line-height: 24px; padding: 10px; border-top: 3px solid #eeeeee; border-bottom: 3px solid #eeeeee;">
                                                    Tổng tiền
                                                </td>
                                                <td width="25%" align="left" style="font-size: 16px; font-weight: 800; line-height: 24px; padding: 10px; border-top: 3px solid #eeeeee; border-bottom: 3px solid #eeeeee;">
                                                    <?php echo number_format($row_order['ORDER_TOTAL'], 0, ',', '.');?> đ
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td align="center" height="100%" valign="top" width="100%" style="padding: 0 35px 35px 35px; background-color: #ffffff;" bgcolor="#ffffff">
                            <table align="center" border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width:660px;">
                                <tr>
                                    <td align="center" valign="top" style="font-size:0;">
                                        <div style="display:inline-block; max-width:50%; min-width:240px; vertical-align:top; width:100%; padding-right:20px    ">

                                            <table align="left" border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width:300px;">
                                                <tr>
                                                    <td align="left" valign="top" style="font-size: 16px; font-weight: 400; line-height: 24px;">
                                                        <p style="font-weight: 800;">Địa chỉ giao hàng</p>
                                                        <p><?php echo $shipping ?></p>
                                                    </td>
                                                </tr>
                                            </table>
                                        </div>
                                        <div style="display:inline-block; max-width:50%; min-width:240px; vertical-align:top; width:100%; padding-left:20px">
                                            <table align="left" border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width:300px;">
                                                <tr>
                                                    <td align="left" valign="top" style="font-size: 16px; font-weight: 400; line-height: 24px;">
                                                        <p style="font-weight: 800;">Ngày giao hàng dự kiến</p>
                                                        <p>05/01/2024</p>
                                                    </td>
                                                </tr>
                                            </table>
                                        </div>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td align="center" style=" padding: 35px; background-color: #ff7361;" bgcolor="#1b9ba3">
                            <table align="center" border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width:600px;">
                                <tr>
                                    <td align="center" style="padding: 25px 0 15px 0;">
                                        <table border="0" cellspacing="0" cellpadding="0">
                                            <tr>
                                                <td align="center" style="border-radius: 5px;" bgcolor="#66b3b7">
                                                    <a href="./index.php"  style="font-size: 18px;  color: #ffffff; text-decoration: none; border-radius: 5px; background-color: #F44336; padding: 15px 30px; border: 1px solid #F44336; display: block;">
                                                        Tiếp tục mua hàng
                                                    </a>
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</section>