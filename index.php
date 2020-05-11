<?php
$customer_list = array(
    "0" => array("name" => "Mai Van Hoan", "day_of_birth" => "1983/08/20", "address" => "Ha Noi", "image" => "images/img1.jpg"),
    "1" => array("name" => "Nguyen Van Nam", "day_of_birth" => "1983/08/21", "address" => "Bac Giang", "image" => "images/img2.jpg"),
    "2" => array("name" => "Nguyen Thai Hoa", "day_of_birth" => "1983/08/22", "address" => "Nam Dinh", "image" => "images/img3.jpg"),
    "3" => array("name" => "Tran Dang Khoa", "day_of_birth" => "1983/08/17", "address" => "Ha Tay", "image" => "images/img4.jpg"),
    "4" => array("name" => "Nguyen Dinh Thi", "day_of_birth" => "1983/08/19", "address" => "Ha Noi", "image" => "images/img5.jpg")
);
function searchByDate($customers, $from_date, $to_date)
{

    if (empty($from_date) && empty($to_date)) {
        return $customers;
    }
    $filtered_customers = [];
    foreach ($customers as $customer) {
        if (!empty($from_date) && (strtotime($customer['day_of_birth']) < strtotime($from_date)))
            continue;
        if (!empty($to_date) && (strtotime($customer['day_of_birth']) > strtotime($to_date)))
            continue;
        $filtered_customers[] = $customer;
    }
    return $filtered_customers;
}

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<style>
    table {
        border-collapse: collapse;
        width: 100%;
    }

    th, td {
        padding: 8px;
        text-align: left;
        border-bottom: 1px solid #dddddd;
        #ddd;
    }

    input#from, #to {
        width: 200px;
        border: 2px solid #ccc;
        border-radius: 4px;
        font-size: 16px;
        padding: 12px 10px 12px 10px;
    }

    input[type="submit"] {
        border-radius: 2px;
        padding: 12px 32px;
        font-size: 16px;
    }

    .profile {
        height: 60px;
        width: 80px;
        overflow: hidden;
    }

    img {
        width: 100%;
    }
</style>
<body>
<?php
$from_date = NULL;
$to_date = NULL;
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $from_date = $_POST["from"];
    $to_date = $_POST["to"];
}
$filtered_customers = searchByDate($customer_list, $from_date, $to_date);
?>
<form method="post">
    Từ: <input id="from" type="text" name="from" placeholder="yyyy/mm/dd"/>
    Đến: <input id="to" type="text" name="to" placeholder="yyyy/mm/dd"/>
    <input type="submit" value="Lọc"/>
</form>

<table border="0">
    <caption><h2>Danh sach khach hang</h2></caption>
    <tr>
        <th>STT</th>
        <th>Ten</th>
        <th>Ngay sinh</th>
        <th>Dia chi</th>
        <th>Anh</th>
    </tr>

    <?php foreach ($filtered_customers as $index => $customer): ?>
        <tr>
            <td><?php echo $index + 1;?></td>
            <td><?php echo $customer['name'];?></td>
            <td><?php echo $customer['day_of_birth'];?></td>
            <td><?php echo $customer['address'];?></td>
            <td><div class="profile"><img src="<?php echo $customer['image'];?>" alt="images"/></div> </td>
        </tr>
    <?php endforeach; ?>
</table>

</body>
</html>