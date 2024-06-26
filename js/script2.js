
var closeBtn = document.getElementById('edit_modal_close_btn');
closeBtn.addEventListener('click', function() {
  window.history.back();
});

window.addEventListener('keydown', function(e) {
  if (e.key === 'Escape') {
    window.history.back();
  }
}) ;


let optionsButtons = document.querySelectorAll('.option_button');
let advancedOptionButton = document.querySelectorAll(".adv_option_button");
let fontName = document.getElementById("fontName");
let fontSizeRef = document.getElementById("fontSize");
let writingArea = document.getElementById("text_input_edit_note");
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


document.getElementById('edit_note_form').addEventListener('submit', function(event) {
  // Получаем содержимое элемента с атрибутом contenteditable
  var editedContent = document.getElementById('text_input_edit_note').innerHTML;

  // Помещаем содержимое в скрытое поле формы
  document.getElementById('hidden_note_text').value = editedContent;
});

//Счетчик количества символов в поле для создания заметки

var countTitle = document.getElementById('note_title_edit');
var submitButton = document.getElementById('edit_note_btn');
var countText = document.getElementById('text_input_edit_note');
var result = document.getElementById('result');
var limit = 400;

// Ограничения для заголовка 

countTitle.addEventListener("input", function() {
  var textLength = countText.textContent.length;
  var titleLength = countTitle.value.length;

 if( titleLength === 0 || textLength === 0) {
   countTitle.style.borderColor = "red";
   submitButton.setAttribute('disabled', '');
 }else{ 
   countTitle.style.borderColor = "black";
   submitButton.removeAttribute('disabled');
 }
});

result.textContent = countText.textContent.length + "/" + limit;

countText.addEventListener("input", function() { 
  var titleLength = countTitle.value.length;
  var textLength = countText.textContent.length;
  result.textContent = textLength + "/" + limit;

  if(textLength >= limit || textLength === 0 || titleLength === 0) {
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