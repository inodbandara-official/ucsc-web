<div class="container">
<table class="table table-striped">
    <thead>
        <tr>
            <th>S.N.</th>
            <th>Product Image</th>
            <th>Product Name</th>
            <th>Quantity</th>
            <th>Unit Price</th>
        </tr>
    </thead>
    <?php
        include_once "../config/dbconnect 2.php";
        $ID= $_GET['orderID'];
        //echo $ID;
        $sql="SELECT * from product_status v, order_details d 
        where v.status_id=d.status_id AND
        d.order_id=$ID";
        $result=$conn-> query($sql);
        $count=1;
        if ($result-> num_rows > 0){
            while ($row=$result-> fetch_assoc()) {
                $v_id=$row['status_id'];
    ?>
                <tr>
                    <td><?=$count?></td>
                    <?php
                       $subqry="SELECT * from product p, product_status v
                       where p.product_id=v.product_id AND v.status_id=$v_id";
                       $res=$conn-> query($subqry);
                       if($row2 = $res-> fetch_assoc()){
                    ?>
                    <td><img height="80px" src="<?=$row2["product_image"]?>"></td>
                    <td><?=$row2["product_name"] ?></td>

                   
                    <td><?=$row["quantity"]?></td>
                    <td><?=$row["price"]?></td>
                </tr>
    <?php
                $count=$count+1;
            }
        }else{
            echo "error";
        }
    ?>
</table>
</div>
