let openModalCreateBtn = document.getElementById('open_modal_window');
let modalCreateNote = document.getElementById('modal_create_note');
let modalCreateNoteCloseBtn = document.getElementById('create_modal_close_btn'); 

//Открыть модальное окно для создания 
openModalCreateBtn.addEventListener('click', function() {
  modalCreateNote.classList.add('open');
});

//Закрыть модальное окно создания при нажатии на крестик
modalCreateNoteCloseBtn.addEventListener('click', function() {
    modalCreateNote.classList.remove('open');
})  ;

//Закрыть модальное окно при нажатии на кнопку Esc
window.addEventListener('keydown', function(e) {
  if (e.key === 'Escape') {
    modalCreateNote.classList.remove('open');
  }
}) ; 

//Текстовое поле для создания заметки

let optionsButtons = document.querySelectorAll('.option_button');
let advancedOptionButton = document.querySelectorAll(".adv_option_button");
let fontName = document.getElementById("fontName");
let fontSizeRef = document.getElementById("fontSize");
let writingArea = document.getElementById("text_input_create_note");
let alignButtons = document.querySelectorAll(".align");
let spacingButtons = document.querySelectorAll(".spacing");
let formatButtons = document.querySelectorAll(".format");
let scriptButtons = document.querySelectorAll(".script");

//Список шрифтов 

let fontList = [
  "Arial",
  "Verdana", 
  "Times New Roman",
  "Garamond",
  "Georgia",
  "Courier New",
  "Cursive",
];

const initializer = () => {
  highlighter(alignButtons, true);
  highlighter(spacingButtons, true);
  highlighter(formatButtons, false);
  highlighter(scriptButtons, true);

  fontList.map(value => {
    let option = document.createElement("option");
    option.value = value;
    option.innerHTML = value;
    fontName.appendChild(option);
  });

};
//main logic
const modifyText = (command, defaultUi, value) => {
  //execCommand executes command on selected text
  document.execCommand(command, defaultUi, value);
};

optionsButtons.forEach(button => {
  button.addEventListener("click", () => {
    modifyText(button.id, false, null);
  });
});
advancedOptionButton.forEach(button => {
  button.addEventListener("change", () => {
    modifyText(button.id, false, button.value);
  });
});

const highlighter = (className, needsRemoval) => {
  className.forEach((button) => {
    button.addEventListener("click", () => {
      //needsRemoval = true means only one button should be highlight and other would be normal
      if (needsRemoval) {
        let alreadyActive = false;
        //If currently clicked button is already active
        if (button.classList.contains("active")) {
          alreadyActive = true;
        }
        //Remove highlight from other buttons
        highlighterRemover(className);
        if (!alreadyActive) {
          //highlight clicked button
          button.classList.add("active");
        }
      } else {
        //if other buttons can be highlighted
        button.classList.toggle("active");
      }
    });
  });
};

const highlighterRemover = (className) => {
  className.forEach((button) => {
    button.classList.remove("active");
  });
};

window.onload = initializer();

//Сохранение введенного текста в инпут при создании

document.getElementById('create_note_btn').addEventListener('click', function() {
  // Получаем содержимое элемента с атрибутом contenteditable
  let editedContent = document.getElementById('text_input_create_note').innerHTML;

  // Помещаем содержимое в скрытое поле формы
  let hiddenField = document.createElement('input');
  hiddenField.type = 'hidden';
  hiddenField.name = 'note_text';
  hiddenField.value = editedContent; 
  
  document.getElementById('add_note_form').appendChild(hiddenField);
});

//Счетчик количества символов в поле для создания заметки

var countText = document.getElementById('text_input_create_note');

var countTitle = document.getElementById('note_title_input');

var result = document.getElementById('result');

var submitButton = document.getElementById('create_note_btn');
var limit = 400;

result.textContent = countText.textContent.length + "/" + limit;

// Ограничения для заголовка 

countTitle.addEventListener("input", function() {
   var titleLength = countTitle.value.length;

  if( titleLength === 0) {
    countTitle.style.borderColor = "red";
    submitButton.setAttribute('disabled', '');
  }else{ 
    countTitle.style.borderColor = "black";
    submitButton.removeAttribute('disabled');
  }
});
// Ограничения для текста

countText.addEventListener("input", function() {
  var textLength = countText.textContent.length;
  
  result.textContent = textLength + "/" + limit;

  if(textLength >= limit || textLength === 0) {

    countText.style.borderColor = "red";
    result.style.color = "red";
    submitButton.setAttribute('disabled', '');
  }
  else{
    countText.style.borderColor = "black";
    result.style.color = "black";
    submitButton.removeAttribute('disabled');
  }
});


// Работа с папками

var DealyFolder = document.getElementById('deaily_folder');
var AllFolder = document.getElementById('all_folder');
var MainFolder = document.getElementById('main_folder');  
var PlanFolder = document.getElementById('plan_folder');  
var SideFolder = document.getElementById('side_folder');  
const allNotes = document.getElementsByClassName("note_block");

AllFolder.addEventListener('click', function() {
  for (var i = 0; i < allNotes.length; i++) {
    var div = allNotes[i];
    div.style.display = "block"; 
  }
});

DealyFolder.addEventListener('click', function() {

  for (var i = 0; i < allNotes.length; i++) {
    var div = allNotes[i];
    div.style.display = "block"; 
    
    // Проверяем id каждого div
    if (div.id !== "Ежедневные задачи") {
        // Если id отличается, скрываем div
        div.style.display = "none";
    }
}
});

MainFolder.addEventListener('click', function() {
  for (var i = 0; i < allNotes.length; i++) {
    var div = allNotes[i];
    div.style.display = "block";

    // Проверяем id каждого div
    if (div.id !== "Главные задачи") {
      // Если id отличается, скрываем div
      div.style.display = "none";
    }
  }
});

PlanFolder.addEventListener('click', function() {
  for (var i = 0; i < allNotes.length; i++) {
    var div = allNotes[i];
    div.style.display = "block";

    // Проверяем id каждого div
    if (div.id !== "Планируемые задачи") {
      // Если id отличается, скрываем div
      div.style.display = "none";
    }
  }
});

SideFolder.addEventListener('click', function() {
  for (var i = 0; i < allNotes.length; i++) {
    var div = allNotes[i];
    div.style.display = "block";

    // Проверяем id каждого div
    if (div.id !== "Второстепенные задачи") {
      // Если id отличается, скрываем div
      div.style.display = "none";
    }
  }
});

function search() {
  // Получаем значение из поля ввода
  let searchText = document.getElementById('search').value.toLowerCase();

  // Получаем все блоки заметок
  let noteBlocks = document.querySelectorAll('.note_block');

  // Перебираем каждый блок заметки
  noteBlocks.forEach(noteBlock => {
      // Получаем текст заголовка и содержимого
      let title = noteBlock.querySelector('.note_title').textContent.toLowerCase();
      let text = noteBlock.querySelector('.note_text').textContent.toLowerCase();

      // Проверяем, содержит ли заголовок или содержимое искомый текст
      if (title.includes(searchText) || text.includes(searchText)) {
          // Если содержит, убираем класс hidden
          noteBlock.classList.remove('hidden');
      } else {
          // Если не содержит, добавляем класс hidden
          noteBlock.classList.add('hidden');
      }
  });
}

function filterRecent() {
  // Получаем текущее время
  let now = new Date();
  // Получаем время 30 минут назад
  let thirtyMinutesAgo = new Date(now.getTime() - 30 * 60 * 1000);

  // Получаем все блоки заметок
  let noteBlocks = document.querySelectorAll('.note_block');

  // Перебираем каждый блок заметки
  noteBlocks.forEach(noteBlock => {
      // Получаем время изменения заметки
      let noteDateText = noteBlock.querySelector('.note_date').innerHTML;
      let noteDate = parseDate(noteDateText);
      console.log (noteDateText);
      console.log(noteDate);
      // Проверяем, была ли заметка изменена в последние 30 минут
      if (noteDate.getTime() >= thirtyMinutesAgo.getTime() && noteDate.getTime() <= now.getTime()) {
        // Если была изменена, убираем класс hidden
        noteBlock.classList.remove('hidden');
      } else {
        // Если не была изменена, добавляем класс hidden
        noteBlock.classList.add('hidden');
      }
  });
}
// Функция для преобразования строки даты в объект Date
function parseDate(dateString) {
  let parts = dateString.match(/(\d{4})-(\d{2})-(\d{2})[T ](\d{2}):(\d{2}):(\d{2})/);
  return new Date(parts[1], parts[2] - 1, parts[3], parts[4], parts[5], parts[6]);
}


function toggleInactiveNotes() {
  // Получаем все блоки заметок
  let noteBlocks = document.querySelectorAll('.note_block');

  // Перебираем каждый блок заметки
  noteBlocks.forEach(noteBlock => {
      // Получаем элемент с id note_active
      let noteActiveElement = noteBlock.querySelector('#note_active');

      // Проверяем, если текст в элементе "Заметка неактивна"
      if (noteActiveElement && noteActiveElement.textContent.includes('Заметка неактивна')) {
          // Если текст соответствует, переключаем класс hidden
          noteBlock.classList.toggle('hidden');
      }
  });
}