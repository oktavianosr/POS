const orderItemIdArray = [];
const orderitemsarray = [];
const orderPriceArray = [];
const orderarray = [];
const orderidarray = [];
const orderImageArray = [];

const orderItemQuantity = [];

let i = 0;

function orderbasket(itemid, itemname, itemprice, itemimage) {
  if (orderitemsarray.indexOf(itemname) > -1) {
    const itemIndexNumber = orderitemsarray.indexOf(itemname);
    orderItemQuantity[itemIndexNumber] = orderItemQuantity[itemIndexNumber] + 1;
    incrementItem(orderidarray[itemIndexNumber], 1);
  } else {
    orderidarray.push(i);

    orderItemIdArray.push(itemid);
    orderitemsarray.push(itemname);
    orderPriceArray.push(itemprice);
    orderImageArray.push(itemimage);
    orderItemQuantity.push(1);

    orderarray.push(itemid, itemname, itemprice, itemimage);

    let orderlist = document.getElementById("orderlist");

    //create the li tag
    const orderitemparent = document.createElement("li");

    const orderitem = document.createElement("span");
    orderitem.className = "d-flex justify-content-between align-items-center";

    //create a span for red color
    const orderitempricespan = document.createElement("span");

    //create the text node with itemname and itemprice
    const orderitemname = document.createTextNode("   " + itemname);
    const orderitemprice = document.createTextNode(formatToRupiah(itemprice));

    //adjust tect color to text-danger
    orderitempricespan.className = "text-danger";

    //attach theitemname tag and itemprice to li tag
    orderitempricespan.appendChild(orderitemprice);

    //create a delte button
    const deletebutton = document.createElement("button");
    const deletebuttontext = document.createTextNode("X");

    deletebutton.setAttribute("onclick", "deleteItem(" + i + ",this)");

    //append the text to deletebutton
    deletebutton.appendChild(deletebuttontext);
    deletebutton.className = "btn btn-outline-danger rounded-pill";

    //Image Section
    //step 1:add image wrc
    const orderitemimgtag = document.createElement("img");

    //assign the src itemimage to img
    orderitemimgtag.src = itemimage;

    //classname w-25 for image
    orderitemimgtag.className = "w-25 rounded border border-dark";

    //create a span for red color
    const orderitemleftsidespan = document.createElement("span");

    //appendChild to LI
    //combine this
    orderitemleftsidespan.appendChild(orderitemimgtag);

    //attach the orderitempricespan SPAN into li tag
    orderitemleftsidespan.appendChild(orderitemname);
    //end of combine

    //add the price at the end
    orderitemleftsidespan.appendChild(orderitempricespan);

    orderitem.appendChild(orderitemleftsidespan);

    //attach the deletebutton into span tag
    orderitem.appendChild(deletebutton);

    //parent baru LI -> SPAN
    orderitemparent.appendChild(orderitem);

    //attach or Append the span tag (child) to parent id=orderlist
    orderlist.appendChild(orderitemparent);

    //button section here
    //add br tag
    const decrementButton = document.createElement("button");
    const incrementButton = document.createElement("button");
    const decrementButtonText = document.createTextNode("-");
    const incrementButtonText = document.createTextNode("+");
    decrementButton.setAttribute("onclick", "incrementItem(" + i + ",-1)");
    incrementButton.setAttribute("onclick", "incrementItem(" + i + ",1)");

    const amountItemSpan = document.createElement("span");
    amountItemSpan.className = "px-3 fw-bold item" + i;
    const amountItemsText = document.createTextNode("1");

    decrementButton.className = "btn-sm btn btn-outline-danger rounded-pill px-3 ms-1 fw-bold";
    incrementButton.className = "btn-sm btn btn-outline-success rounded-pill px-3 fw-bold";

    decrementButton.appendChild(decrementButtonText);
    incrementButton.appendChild(incrementButtonText);
    amountItemSpan.appendChild(amountItemsText);
    orderitemparent.appendChild(incrementButton);
    orderitemparent.appendChild(amountItemSpan);
    orderitemparent.appendChild(decrementButton);
    //increment the i = iterasi
    i++;
  }
  totalitems();
  costitems();
  enableCheckOutButton();
  enableOrderBasketClear();
  // disableAllButtons();
}

function formatToRupiah(number) {
  const formatted = new Intl.NumberFormat("id-ID", {
    style: "currency",
    currency: "IDR",
    minimumFractionDigits: 0,
    maximumFractionDigits: 2,
  }).format(number);

  return formatted.replace(",00", ""); // Menghapus ",00" jika bilangan bulat
}

// function decrementItem() {}

function incrementItem(orderid, val) {
  const itemSpan = document.querySelector(".item" + orderid);
  itemSpan.innerText = parseInt(itemSpan.innerText) + val;
  const indexnum = orderidarray.indexOf(orderid);
  orderItemQuantity[indexnum] = parseInt(itemSpan.innerText);
  totalitems();
  costitems();

  if (itemSpan.innerText == 0) {
    //itemid
    orderItemIdArray.splice(indexnum, 1);

    orderidarray.splice(indexnum, 1);
    orderitemsarray.splice(indexnum, 1);
    orderPriceArray.splice(indexnum, 1);
    orderImageArray.splice(indexnum, 1);
    orderItemQuantity.splice(indexnum, 1);
    // console.log(orderidarray);

    // console.log(itemSpan);
    // console.log(itemSpan.parentElement);
    orderlist.removeChild(itemSpan.parentElement);

    if (orderPriceArray.length === 0) {
      document.getElementById("amount").value = 0;
    }

    enableCheckOutButton();
  }
}

function totalitems() {
  // document.getElementById("totalitems").innerText = orderitemsarray.length;
  if (orderItemQuantity.length) {
    document.getElementById("totalitems").innerText = orderItemQuantity.reduce((total, num) => {
      return total + num;
    });
  } else {
    document.getElementById("totalitems").innerText = 0;
  }
}

function costitems() {
  if (orderPriceArray.length === 0) {
    document.getElementById("totalcost").innerText = "0.00";
  } else {
    const totalTempArray = orderItemQuantity.map((quantity, index) => quantity * parseFloat(orderPriceArray[index] || 0));

    const totalAmount = totalTempArray.reduce((total, num) => total + num, 0);

    // Format jumlah hanya jika ada angka desimal
    const formattedAmount = totalAmount % 1 === 0 ? totalAmount : totalAmount.toFixed(2);

    document.getElementById("amount").value = formattedAmount;
    document.getElementById("totalcost").innerText = formatToRupiah(totalAmount);
  }
}

function totalamountinput() {}

function orderbasketClear() {
  let orderlist = document.getElementById("orderlist");
  document.getElementById("customeramountpaid").value = 0;
  document.getElementById("amount").value = 0;
  orderlist.innerHTML = "";
  orderPriceArray.length = 0;
  orderImageArray.length = 0;
  orderarray.length = 0;
  orderitemsarray.length = 0;
  orderidarray.length = 0;
  orderItemQuantity.length = 0;

  i = 0;
  totalitems();
  costitems();
  disableAllButtons();
  enableOrderBasketClear();
  enableCheckOutButton();
  enableCustomerPaidButton();
  // enableCustomerPaidButton();
}
function deleteItem(orderid, button) {
  const indexnum = orderidarray.indexOf(orderid);

  //itemid
  orderItemIdArray.splice(indexnum, 1);

  orderidarray.splice(indexnum, 1);
  orderitemsarray.splice(indexnum, 1);
  orderPriceArray.splice(indexnum, 1);
  orderImageArray.splice(indexnum, 1);
  orderItemQuantity.splice(indexnum, 1);
  totalitems();
  costitems();
  orderlist.removeChild(button.parentElement.parentElement);

  if (orderPriceArray.length === 0) {
    document.getElementById("amount").value = 0;
  }
  enableCheckOutButton();
  // disableAllButtons();
  // orderidarray;
}

function exactAmountCalculator() {
  document.getElementById("exactamountspan").innerText = document.getElementById("amount").value;
}

const calculatorScreenAmount = document.getElementById("calculatorScreenAmount");

function calculatorInsert(number) {
  if (calculatorScreenAmount.value == 0 && number == "00") {
    calculatorScreenAmount.value = "0.";
  } else if (calculatorScreenAmount.value == 0 && number == "0") {
    calculatorScreenAmount.value = "0.";
  } else if (calculatorScreenAmount.value == "" && number == "00") {
    calculatorScreenAmount.value = "0";
  } else if (calculatorScreenAmount.value.includes(".") === true && number == ".") {
    calculatorScreenAmount.value = calculatorScreenAmount.value;
  } else if (calculatorScreenAmount.value == "0" && number > 0) {
    calculatorScreenAmount.value = number;
  } else {
    calculatorScreenAmount.value += number;
  }
  if (calculatorScreenAmount.vale == ".") {
    calculatorScreenAmount.value = "0.";
  } // Ubahlah format dolar ini menjadi rupiah nanti

  enableconfirmPaidButton();
}

function exactAmountButton() {
  calculatorScreenAmount.value = document.getElementById("amount").value;
  enableconfirmPaidButton();
}

function denominationButton(bill) {
  console.log(calculatorScreenAmount.value);
  console.log(parseFloat(calculatorScreenAmount.value));
  calculatorScreenAmount.value = parseFloat(calculatorScreenAmount.value) + bill;
  enableconfirmPaidButton();
}

function calculatorCancel() {
  calculatorScreenAmount.value = "0";
  enableconfirmPaidButton();
}

function enableconfirmPaidButton() {
  document.getElementById("confirmPaid").disabled = true;
  if (parseFloat(calculatorScreenAmount.value) >= parseFloat(document.getElementById("amount").value)) {
    document.getElementById("confirmPaid").disabled = false;
  }
  // calculatorScreenAmount.value = "";
}

// function sendDataToServer() {
//   const data = {
//     orderItemIdArray,
//     orderitemsarray,
//     orderPriceArray,
//     orderItemQuantity,
//     orderImageArray,
//   };

//   fetch("save_order.php", {
//     method: "POST",
//     headers: {
//       "Content-Type": "aplication/json",
//     },
//     body: JSON.stringify(data),
//   })
//     .then((response) => response.json())
//     .then((result) => {
//       if (result.success) {
//         alert("Order berhasil");
//       }
//     });
// }

function confirmPaidButton() {
  // orderidarray;
  // orderitemsarray;
  // orderPriceArray;
  // orderItemQuantity;

  const amount = parseFloat(document.getElementById("amount").value);
  const paid = parseFloat(document.getElementById("calculatorScreenAmount").value);
  //change
  const change = paid - amount;
  const name = document.getElementById("customername").value;

  // if (
  //   orderItemIdArray.length !== orderitemsarray.length ||
  //   orderPriceArray.length !== orderItemQuantity.length
  // ) {
  //   console.error("Array tidak konsisten!");
  //   return;
  // }
  

  const orderData = {
    orderAmount: amount,
    orderCustomerPaid: paid,
    orderChange: change,
    orderCustomer: name,
    orderItems: orderitemsarray.map((item, index) => ({
      itemId: orderItemIdArray[index],
      itemName: orderitemsarray[index],
      itemPrice: orderPriceArray[index],
      itemQuantity: orderItemQuantity[index],
    })),
  };

  fetch("save_order.php", {
    method: "POST",
    headers: {
      "Content-Type": "application/json",
      Accept: "application/json", // harus ada penerima
    },
    body: JSON.stringify(orderData),
  })
    .then((response) => {
      if (!response.ok) {
        throw new Error(`HTTP error! status: ${response.status}`); // respon jika error
      }
      return response.json();
    })
    .then((result) => {
      if (result.success) {
        Swal.fire({
          title: "Terima Kasih!",
          text: "Pesanan Telah Berhasil!",
          icon: "success",
        });
        // orderbasketClear();
        printReceipt(orderData);
      } else {
        alert("Gagal" + result.message);
      }
    })
    // .catch((error) => {
    //   console.error("Fetch error:", error.message);
    //   Swal.fire({
    //     title: "Error",
    //     text: "Terjadi kesalahan, mohon coba lagi.",
    //     icon: "error",
    //   });
    // });

  //order amount
  //amount paid
  //any change
  //customername

  //itemname
  //itemid
  //itemquantity
  //itemprice

  const customerAmountPaid = document.getElementById("customeramountpaid");
  customerAmountPaid.value = paid.toFixed(2);
  document.getElementById("customername").disabled = true;

  customerAmountPaid.value = calculatorScreenAmount.value;
  const customerAmountChange = document.getElementById("customeramountchange");
  customerAmountChange.value = change.toFixed(2);
  customerAmountChange.value = customerAmountPaid.value - document.getElementById("amount").value;

  document.getElementById("calculatorModal").disabled = true;
  // custumeramountchange
  enableNextCustomerAndPrintButton();
  disableAllButtons();
}

function enableCustomerPaidButton() {
  document.getElementById("calculatorModal").disabled = false;
}

function enableNextCustomerAndPrintButton() {
  document.getElementById("printReceiptButton").disabled = false;
  document.getElementById("customerNextButton").disabled = false;
}

function updateOrderDate() {
  fetch("get_latest_order_date.php")
    .then((response) => response.json())
    .then((data) => {
      if (data.success) {
        // Perbarui elemen HTML dengan tanggal terbaru
        document.getElementById("latestOrderId").innerText = data.orderId;
        document.getElementById("latestOrderDate").innerText = data.orderDateTime;
      } else {
        console.error(data.message);
      }
    })
    .catch((error) => console.error("Error fetching order date:", error));
}

function nextCustomerButton() {
  orderbasketClear();
  document.getElementById("pills-food-tab").disabled = false;
  document.getElementById("pills-drink-tab").disabled = false;
  document.getElementById("pills-snack-tab").disabled = false;
  document.getElementById("pills-hotdrink-tab").disabled = false;

  // enableCustomerPaidButton();
  updateOrderDate();
}

// function enablFoodAndDrinkTab() {
//   document.getElementById("pills-food-tab").disabled = false;
//   document.getElementById("pills-drink-tab").disabled = false;
// }

function disableAllButtons() {
  // document.getElementById("pills-food-tab").disabled = true;
  // document.getElementById("pills-drink-tab").disabled = true;
  document.getElementById("calculatorModal").disabled = true;
  document.getElementById("checkOutButton").disabled = true;
  document.getElementById("orderBasketClearButton").disabled = true;
  const allButtons = document.getElementById("orderlist").querySelectorAll("button");
  const buttons = document.querySelectorAll("#pills-tab button");
  buttons.forEach((button) => {
    button.disabled = true; // Nonaktifkan semua tombol
  });
  for (let i = 0; i < allButtons.length; i++) {
    allButtons[i].disabled = true;
  }
}

function enableOrderBasketClear() {
  const orderbasketClear = document.getElementById("orderBasketClearButton");

  if (orderidarray.length > 0) {
    orderbasketClear.disabled = false;
  }
}

function enableCheckOutButton() {
  const checkOutButton = document.getElementById("checkOutButton");
  checkOutButton.disabled = true;

  if (orderidarray.length > 0) {
    checkOutButton.disabled = false;
  }
  if (orderidarray.length == 0) {
    const backToFoodTab = document.getElementById("pills-food-tab");
    const FoodTab = new bootstrap.Tab(backToFoodTab);
    FoodTab.show();
  }
}

function goToCheckOutTab() {
  document.getElementById("pills-food-tab").disabled = true;
  document.getElementById("pills-drink-tab").disabled = true;
  document.getElementById("pills-snack-tab").disabled = true;
  const firstTabEl = document.getElementById("pills-checkout-tab");
  const firstTab = new bootstrap.Tab(firstTabEl);

  firstTab.show();
}
