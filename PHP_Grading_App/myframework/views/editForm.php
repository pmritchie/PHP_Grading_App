<div class="container">
  <div class="form">
    <form action="/welcome/validateInputs" method="POST">
      <h1> Grading App </h1>
      <h2> Edit </h2>
      <div>
        <label>Student Name</label>
        <input type="text" name="name" placeholder="Bob" value="<? echo $data["studentname"]?>"/>
      </div>
      <div>
        <label>Student Grade</label>
        <input type="text" name="percent" placeholder="80" value="<? echo $data["studentpercent"]?>"/>
        <input name="id" type="hidden" value="<?echo $data["studentid"]?>" /><br>
      </div>
      <button type="submit" name="save" >Save</button>
    </form>
  </div>
</div>
