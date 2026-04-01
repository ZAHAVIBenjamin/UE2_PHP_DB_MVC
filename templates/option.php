<h2 style="color: goldenrod; text-align: center;">Option</h2>
<div id="optionCorp">
  <img
    id="optionImg"
    src="image/optionImage.png"
    alt="Image de Lorthan"
  />
  <div id="optionItem">
    <form id="optionForm" action="index.php?page=option" method="POST">
    <label for="newsLetter">S'abonner à la newsletter :</label>
    <input class="checkbox" type="checkbox" 
           name="newsLetter" 
           id="newsLetter" 
           <?= $isSubscribed ? 'checked' : '' ?>>
    
    <button type="submit" name="newsLetter_submit">Enregistrer</button>
    </form>
    <div id="API"></div>
  </div>
</div>
      
