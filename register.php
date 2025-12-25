<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <title>Register</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f2f6f9;
            margin: 0;
            padding: 20px;
        }

        .container {
            max-width: 700px;
            margin: auto;
            background: #ffffff;
            padding: 25px;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.1);
        }

        h2, h3 {
            text-align: center;
            color: #333;
        }

        label {
            font-weight: bold;
        }

        input[type="text"],
        input[type="email"],
        select {
            width: 100%;
            padding: 8px;
            margin-top: 5px;
            margin-bottom: 15px;
            border-radius: 5px;
            border: 1px solid #ccc;
        }

        .option-group {
            margin-bottom: 15px;
        }

        button {
            background: #007bff;
            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            width: 100%;
        }

        button:hover {
            background: #0056b3;
        }

        .result {
            background: #e9f7ef;
            padding: 15px;
            border-radius: 8px;
            margin-top: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }

        table th, table td {
            border: 1px solid #ccc;
            padding: 8px;
            text-align: center;
        }

        table th {
            background: #007bff;
            color: #fff;
        }

        table tr:nth-child(even) {
            background: #f2f2f2;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>ฟอร์มลงทะเบียนอบรม</h2>

    <form method="post">
        <label>ชื่อ-นามสกุล</label>
        <input type="text" name="fullname" required>

        <label>Email</label>
        <input type="email" name="email" required>

        <label>หัวข้ออบรม</label>
        <select name="course">
            <option value="AI สำหรับงานสำนักงาน">AI สำหรับงานสำนักงาน</option>
            <option value="Excel สำหรับการทำงาน">Excel สำหรับการทำงาน</option>
            <option value="การเขียนเว็บด้วย PHP">การเขียนเว็บด้วย PHP</option>
        </select>

        <div class="option-group">
            <label>อาหารที่ต้องการ</label><br>
            <input type="checkbox" name="food[]" value="ปกติ"> ปกติ
            <input type="checkbox" name="food[]" value="มังสวิรัติ"> มังสวิรัติ
            <input type="checkbox" name="food[]" value="ฮาลาล"> ฮาลาล
        </div>

        <div class="option-group">
            <label>รูปแบบการเข้าร่วม</label><br>
            <input type="radio" name="type" value="Onsite" required> Onsite
            <input type="radio" name="type" value="Online"> Online
        </div>

        <button type="submit" name="submit">ลงทะเบียน</button>
    </form>

    <?php
    if (isset($_POST['submit'])) {
        $fullname = $_POST['fullname'];
        $email = $_POST['email'];
        $course = $_POST['course'];
        $type = $_POST['type'];

        if (isset($_POST['food'])) {
            $food = implode(",", $_POST['food']);
        } else {
            $food = "ไม่ระบุ";
        }

        $price = ($type == "Onsite") ? 1500 : 800;

        $data = $fullname . "|" . $email . "|" . $course . "|" . $food . "|" . $type . "|" . $price . "\n";
        file_put_contents("register.txt", $data, FILE_APPEND);

        echo "<div class='result'>
                <h3>ลงทะเบียนสำเร็จ</h3>
                ชื่อ: $fullname <br>
                อีเมล: $email <br>
                หัวข้ออบรม: $course <br>
                อาหาร: $food <br>
                รูปแบบ: $type <br>
                ค่าลงทะเบียน: " . number_format($price, 2) . " บาท
              </div>";
    }
    ?>

    <h3>รายชื่อผู้ลงทะเบียนทั้งหมด</h3>

    <?php
    if (file_exists("register.txt")) {
        $lines = file("register.txt");

        echo "<table>
                <tr>
                    <th>ชื่อ</th>
                    <th>Email</th>
                    <th>หัวข้อ</th>
                    <th>อาหาร</th>
                    <th>รูปแบบ</th>
                    <th>ค่าลงทะเบียน</th>
                </tr>";

        foreach ($lines as $line) {
            list($name, $email, $course, $food, $type, $price) = explode("|", trim($line));
            echo "<tr>
                    <td>$name</td>
                    <td>$email</td>
                    <td>$course</td>
                    <td>$food</td>
                    <td>$type</td>
                    <td>" . number_format($price, 2) . "</td>
                  </tr>";
        }
        echo "</table>";
    }
    ?>
</div>

</body>
</html>
