var exampleModal = document.getElementById('modalPaket')
exampleModal.addEventListener('show.bs.modal', function (event) {
  // Button that triggered the modal
  var button = event.relatedTarget
  // Extract info from data-bs-* attributes
  var game_id = button.getAttribute('data-bs-whatever')
  var paket_id = '0';
  var nama_game = button.getAttribute('data-bs-whatever2')
  // If necessary, you could initiate an AJAX request here
  // and then do the updating in a callback.
  //
  // Update the modal's content.
  var modalTitle = exampleModal.querySelector('.modal-title')
  //   var modalBodyInput = exampleModal.querySelector('.modal-body input')

  modalTitle.textContent = 'Paket - ' + nama_game;
  //   modalBodyInput.value = recipient

  x = document.getElementById('list_paket');

  //change to loading 1st
  x.innerHTML = '<center><img src="assets/core/image/loading.gif" alt="" style="width:auto;height:100px;"></center>';
  
  // Test API code
  // const app = document.getElementById('root');

  // const logo = document.createElement('img');
  // logo.src = 'logo.png';

  // const container = document.createElement('div');
  // container.setAttribute('class', 'container');

  // app.appendChild(logo);
  // app.appendChild(container);

  var request = new XMLHttpRequest();
  request.open('GET', 'http://localhost:8080/api/getpaket?game_id='+game_id , true);
  request.onload = function () {
    // Begin accessing JSON data here
    var result = JSON.parse(this.response);
    if (request.status >= 200 && request.status < 400) {
      // data.forEach(movie => {
      //   const card = document.createElement('div');
      //   card.setAttribute('class', 'card');

      //   const h1 = document.createElement('h1');
      //   h1.textContent = movie.title;

      //   const p = document.createElement('p');
      //   movie.description = movie.description.substring(0, 300);
      //   p.textContent = `${movie.description}...`;

      //   container.appendChild(card);
      //   card.appendChild(h1);
      //   card.appendChild(p);
      // });
      // alert(result.data[0].nama_paket);
      // resultdata = result.data;

      let text = "";
      result.data.forEach(a => {
        // alert(a.nama_paket);
        text += '<a href="http://localhost:8080/paket/'+game_id+'/'+a.kode_paket+'" class="col-lg-3 col-4 my-1 mb-2 text-none p-1" style="text-decoration:none;"><div class="row"><div class="col-lg-10 col-12 m-auto d-block"><img src="/assets/uploaded/image/icon/'+a.ikon_paket+'" class="img-fluid img-logo"></div><div class="col-lg-10 col-12 text-center m-auto mt-2 d-block"><span class="text-black fw-bold">'+a.nama_paket+'</span></div></div>';
      });

      //then change to result from api
      x.innerHTML = text;
      
    } else {
      // const errorMessage = document.getElementsByClassName('nama_paket');
      // errorMessage.textContent = `Gah, it's not working!`;
      // app.appendChild(errorMessage);
      x.innerHTML = 'Load paket error... silakan hubungi admin';
    }
  }
  request.send();

  // Gatau bentar
  var req = new XMLHttpRequest();
  // req.onreadystatechange = function(){
  //   if (this.readyState == 4 && this.status == 200) {
  //     document.getElementById("demo").innerHTML = this.responseText;
  //   }
  // }
  req.open('POST', 'http://localhost:8080/api/recordAct');
  req.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
  req.send('game_id='+game_id+'&paket_id='+paket_id);
})
