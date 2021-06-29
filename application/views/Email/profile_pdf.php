
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-ca">
    <table    align="center" border="0" cellpadding="0" cellspacing="0" width="700" style="background: #ff9800;
              font-family: sans-serif;
              padding: 10px;
              margin-bottom: 10px;">
        <tr>
            <td style="text-align: center;color:white;">
                <img src="<?php echo SITE_LOGO; ?>" style="height: 50px;">
                    <br/>
                    <h5>www.shadimychoice.com</h5>
                    <h3><?php echo $data["member_id"]; ?></h3>
            </td>
        </tr>
    </table>
    <table    align="center" border="0" cellpadding="0" cellspacing="0" width="700" style="background: #fff;font-family: sans-serif;">
        <tr>
            <td><h2><?php echo $data["baseProfile"]["name"]; ?><br/><small style="font-size: 12px;color:gray">
                        <?php echo $data["baseProfile"]["profession"]; ?>
                    </small></h2></td>
            <td rowspan="4" style="text-align: right;">
                <img src="<?php echo $data["baseProfile"]["profile_image"]; ?>" style="    height: 150px;

                     background-position: top;
                     background-size: cover;
                     ">

            </td>
        </tr>
        <tr>
            <td><h4><?php echo $data["baseProfile"]["age"]; ?> Years</h4></td>

        </tr>
        <tr>
            <td><h4><?php echo $data["baseProfile"]["religion"]; ?> - <?php echo $data["baseProfile"]["community"]; ?></h4></td>

        </tr>
        <tr>
            <td><h4><?php echo $data["baseProfile"]["city"]; ?> - <?php echo $data["baseProfile"]["state"]; ?></h4></td>

        </tr>
    </table>
    <table    align="center" border="1" cellpadding="0" cellspacing="0" width="700" style="background: #fff;margin-top:10px;">

        <?php
        if (isset($data["contact"])) {
            ?>
            <tr style="font-weight: bold">
                <td colspan="5" style="text-align: left;padding: 10px;border: 1px solid rgb(157, 153, 150);    background: #ff5722;
                    color: white;
                    font-family: sans-serif;">
                    <h3 style="    margin: 0;">Contacts</h3>

                </td>

            </tr>
            <tr>
                <td style="text-align: left;padding: 10px;border: 1px solid rgb(157, 153, 150); 
                    font-family: sans-serif;">Contact Name</td>
                <td style="text-align: left;padding: 10px;border: 1px solid rgb(157, 153, 150);  
                    font-family: sans-serif;">Relation</td>
                <td style="text-align: left;padding: 10px;border: 1px solid rgb(157, 153, 150);  
                    font-family: sans-serif;">Contact No.</td>
                <td style="text-align: left;padding: 10px;border: 1px solid rgb(157, 153, 150);   
                    font-family: sans-serif;">Email</td>
                <td style="text-align: left;padding: 10px;border: 1px solid rgb(157, 153, 150);   
                    font-family: sans-serif;">Remark</td>
            </tr>
            <?php
            foreach ($data["contact"] as $ckey => $cvalue) {
                ?>
                <tr style="font-weight: bold">
                    <td  style="text-align: left;padding: 10px;font-size: 12px;
                         font-family: sans-serif;">
        <?php echo $cvalue["name"]; ?>

                    </td>
                    <td  style="text-align: left;padding: 10px;font-size: 12px;
                         font-family: sans-serif;">
        <?php echo $cvalue["relation"]; ?>

                    </td>
                    <td  style="text-align: left;padding: 10px;font-size: 12px;
                         font-family: sans-serif;">
        <?php echo $cvalue["contact_no"]; ?>

                    </td>
                    <td  style="text-align: left;padding: 10px;font-size: 12px;
                         font-family: sans-serif;">
        <?php echo $cvalue["email"]; ?>

                    </td>
                    <td  style="text-align: left;padding: 10px;font-size: 12px;
                         font-family: sans-serif;">
        <?php echo $cvalue["remark"]; ?>

                    </td>


                </tr>
        <?php
    }
}
?>


    </table>
    <table    align="center" border="0" cellpadding="0" cellspacing="0" width="700" style="background: #fff;margin-top:10px;">

<?php
foreach ($fielddata as $hkey => $hvalue) {
    ?>
            <tr style="font-weight: bold">
                <td colspan="2" style="text-align: left;padding: 10px;border: 1px solid rgb(157, 153, 150);    background: #ff5722;
                    color: white;
                    font-family: sans-serif;">
                    <h3 style="    margin: 0;"><?php echo $hvalue["title"]; ?></h3>

                </td>

            </tr>
    <?php
    foreach ($hvalue["elements"] as $fkey => $fvalue) {
        ?>
                <tr style="font-weight: bold">
                    <td  style="text-align: left;padding: 10px;font-size: 12px;
                         font-family: sans-serif;">
                        <h3><?php echo $fvalue["title"]; ?></h3>

                    </td>
                    <td  style="text-align: left;padding: 10px;font-size: 12px;
                         font-family: sans-serif;">
                        <h3><?php echo $data[$fvalue["field"]]; ?></h3>

                    </td>

                </tr>
        <?php
    }
}
?>
        <tr style="font-weight: bold">
            <td colspan="2" style="text-align: left;padding: 10px;border: 1px solid rgb(157, 153, 150);    background: #ff5722;
                color: white;
                font-family: sans-serif;">
                <h3 style="    margin: 0;">Images</h3>

            </td>

        </tr>

<?php
foreach ($data["profile_photo_all"] as $fkey => $fvalue) {
    ?>
            <tr style="font-weight: bold">

                <td colspan="2"  style="text-align: center;padding: 10px;font-size: 12px;
                    font-family: sans-serif;">
                    <img src="<?php echo $fvalue; ?>" style="width:500px">

                </td>


            </tr>
    <?php
}
?>
    </table>

</html>