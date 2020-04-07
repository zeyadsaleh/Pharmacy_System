if (String(window.location.href).includes("orders/create")) {
    var items = 1;
    let addHtml = document.getElementById("tbody");
    let addBtn = document.querySelector("#add-medicine");
    let rsBtn = document.querySelector("#rs-medicine");
    let rmBtn = document.querySelector("#rm-medicine");
    let atBtn = document.querySelector("#actions-buttons");

    addBtn.addEventListener("click", addMedicine);


    function addMedicine() {

        let medicine = document.getElementById("medicine").value;
        let price = document.getElementById("price").value;
        let quantity = document.getElementById("quantity").value;
        let type = document.getElementById("type").value;

        if (true && items < 10) {
          // if( medicine && Number.isInteger(price) && Number.isInteger(quantity) && type && medicine != 'Select Medicine' && type != 'Select Type'){
          atBtn.classList.remove('d-none');

          let box = document.createElement("tr");
          box.id = `row-${items}`;
          box.style.opacity = "0.8";
          let html = `<td colspan="2"><input type="text" class="form-control text-center" value="${medicine}" name="medicine${items}" id="medicine${items}" readonly ></td><td><input type="text" class="form-control text-center" value="${type}" name="type${items}" id="type${items}" readonly ></td><td><input type="number" class="form-control text-center" value="${quantity}" name="quantity${items}" id="quantity${items}" readonly ></td><td><input type="number" class="form-control text-center" value="${price}" name="price${items}" id="price${items}" readonly ></td>`

          box.innerHTML = html;
          addHtml.append(box);
          document.getElementById('items').value = items;
          items++;

        } else if (items >= 10) {
            alert("you have reach the limited number of medicines for this order!")
        } else {
            alert("please fill this Medicine Info, to add more..!")
        }

    }

    rsBtn.addEventListener("click", rsMedicine);

    function rsMedicine() {
        deleteChild(addHtml);
        atBtn.classList.add('d-none');
        items = 1;
        document.getElementById('items').value = 0;
    }

    rmBtn.addEventListener("click", rmMedicine);

    function rmMedicine() {
        addHtml.removeChild(addHtml.lastElementChild);
        items--;
        if(items == 1){atBtn.classList.add('d-none');
        document.getElementById('items').value = items;
}
    }
    function deleteChild(ele) {
      let child = ele.lastElementChild;
      while (child) {
          ele.removeChild(child);
          child = ele.lastElementChild;
      }
    }
  }
