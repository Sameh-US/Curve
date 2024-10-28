
// الدالة المسئولة عن جمع البيانات من الجدول
function getDataFromTable() {
  const tabletDataFrom = document.getElementById("stepFanTable");
  const data = [];

  for (let i = 0; i < tabletDataFrom.rows.length; i++) {
    const rowData = [];
    for (let j = 0; j < tabletDataFrom.rows[i].cells.length; j++) {
      const cell = tabletDataFrom.rows[i].cells[j];
      const input = cell.querySelector("input[type='number']");
      if (input) {
        rowData.push(parseFloat(input.value)); // تحويل القيمة إلى رقم
      } else {
        rowData.push(cell.textContent); // إذا لم يكن هناك input، نأخذ النص
      }
    }
    data.push(rowData);
  }
  $DataTable = data;
}

// عند تغيير قيمه الانبوت في الجدول
// يمكنك تنفيذ الدالة المطلوبة
const tableFanTable = document.getElementById("stepFanTable");
tableFanTable.addEventListener("change", (event) => {
  if (event.target.tagName.toLowerCase() === "input") {
    const newValue = event.target.value;
    console.log("تم تغيير القيمة إلى:", newValue);
    // هنا يمكنك تنفيذ الدالة المطلوبة مع تمرير newValue كمعامل
    updateSomething(newValue);
  }
});

// عند تغيير قيمه الانبوت في الجدول
function updateSomething(value) {
  createCurve();
}

// End Chart //

const active = document.querySelector(".navbar-toggler");
const links = document.querySelector(".linkToggle");
active.addEventListener("click", () => {
  if (links.classList.contains("active")) {
    document.querySelector(".linkToggle").classList.remove("active");
    document.querySelector(".linkToggle").classList.add("normal");
  } else {
    document.querySelector(".linkToggle").classList.add("active");
    document.querySelector(".linkToggle").classList.remove("normal");
  }
});

const table = document.querySelector(".table");
table.addEventListener("mouseover", (event) => {
  const target = event.target;
  if (target.tagName === "TD") {
    const row = target.parentNode; // الحصول على صف الخلية
    const cells = row.querySelectorAll("td"); // الحصول على جميع خلايا الصف
    // الحصول على جميع الصفوف في الجدول
    const rows = table.querySelectorAll("tr");

    // تحديد مؤشر العمود
    const columnIndex = Array.from(cells).indexOf(target) + 1;

    // تغيير لون جميع الخلايا في العمود
    rows.forEach((row) => {
      row.cells[columnIndex - 1].style.backgroundColor = "var(--color4)";
    });
  }
});
table.addEventListener("mouseout", (event) => {
  const target = event.target;
  if (target.tagName === "TD") {
    const row = target.parentNode; // الحصول على صف الخلية
    const cells = row.querySelectorAll("td"); // الحصول على جميع خلايا الصف
    // الحصول على جميع الصفوف في الجدول
    const rows = table.querySelectorAll("tr");

    // تحديد مؤشر العمود
    const columnIndex = Array.from(cells).indexOf(target) + 1;

    // تغيير لون جميع الخلايا في العمود
    rows.forEach((row) => {
      row.cells[columnIndex - 1].style.backgroundColor = "Transparent";
    });
  }
});

// End Table //


