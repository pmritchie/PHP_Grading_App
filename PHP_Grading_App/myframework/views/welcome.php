<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>The Grader</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="../assets/style.css">
</head>
<body>


  <?if (isset($_SESSION['errormsg'])): ?>
  <div class="errors">
    <div class="errormsg">
  <?
    echo $_SESSION['errormsg'];
    unset($_SESSION['errormsg']);
  ?>
    </div>
  </div>
  <?endif?>



<div class="container">
  <div class="table">
    <table>
      <thead>
        <tr>
          <th>ID</th>
          <th>Name</th>
          <th>Percent</th>
          <th>Grade</th>
        </tr>
      </thead>
      <tbody>
      <?foreach ($data['grades'] as $student): ?>
        <tr>
          <td><?=$student["studentid"]?></td>
          <td><?=$student["studentname"]?></td>
          <td><?=$student["studentpercent"]?>%</td>
          <td><?=$student["studentlettergrade"]?></td>
          <td>
            <a href="/welcome/update?studentid=<?echo $student['studentid'];?>">Edit</a>
          </td>
          <td>
            <a href="/welcome/delete?studentid=<?echo $student['studentid']?>">Delete</a>
          </td>
        </tr>
        <?endforeach?>
      </tbody>
    </table>
  </div>
</div>

