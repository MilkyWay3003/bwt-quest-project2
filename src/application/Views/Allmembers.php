<div class="container">
<div class="members">  All members (178)</div>

   <br>    
    <table >   
    <tbody>
    <?php foreach($members as $member) : ?>
      <tr>
        <td><?php echo "<img src='" . $member['photo'] . "'" . "alt = " . "Photo" ." >"?></td>
        <td><?php echo $member['firstname']?>  <?php echo $member['lastname']?> </td>
        <td><?php echo $member['reportsubject']?> </td>
        <td><?php echo "<a href='" . "mailto:" . $member['email'] . "'>" . $member['email']. "</a>"?>  </td>
      </tr>
    <?php endforeach; ?>
  </tbody>
  </table>

</div>
</div>