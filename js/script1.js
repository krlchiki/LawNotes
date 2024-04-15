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


// Тестовое поле 

let optionsButtons = document.querySelectorAll('.option_button');
let advancedOptionButton = document.querySelectorAll(".adv_option_button");
let fontName = document.getElementById("fontName");
let fontSizeRef = document.getElementById("fontSize");
let writingArea = document.getElementById("text_input");
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

  for (let i = 1; i <= 7; i++) {
    let option = document.createElement("option");
    option.value = i;
    option.innerHTML = i;
    fontSizeRef.appendChild(option);
  };

  fontSizeRef.value = 3;
};

const modifyText = (command,defaultUi, value) => {
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
  var editedContent = document.getElementById('text_input_create_note').innerHTML;

  // Помещаем содержимое в скрытое поле формы
  var hiddenField = document.createElement('input');
  hiddenField.type = 'hidden';
  hiddenField.name = 'note_text';
  hiddenField.value = editedContent;
  
  document.getElementById('add_note_form').appendChild(hiddenField);
});


