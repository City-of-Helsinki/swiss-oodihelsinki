var omistuskirjoitusScripts = {
  words_element: null,
  count: 0,
  max_rows: 10,
  row: 0,
  html: '',
  prev_random_place: 0,
  langs: null,
  word_count: 0,
  lang_key: 'omistuskirjoitus_lang',
  togglePopup: function() {
    let popup = document.getElementById("omistuskirjoitus-introduction-popup");
    if(!popup.classList.contains("active")) {
      
      /*
      let elements_to_be_hidden = document.getElementsByClassName("omistuskirjoitus-popup-aria-hidden"),
        len = elements_to_be_hidden !== null ? elements_to_be_hidden.length : 0,
        i = 0;
      for(i; i < len; i++) {
          elements_to_be_hidden[i].setAttribute("aria-hidden","true"); 
      }
      */
      
      popup.classList.add("active");
      
      document.querySelector('a.omistuskirjoitus-introduction').setAttribute("aria-expanded","true"); 
      popup.querySelector(".omistuskirjoitus-popup-close-btn").focus();
      //popup.querySelector('.omistuskirjoitus-introduction h2').focus();
      window.scrollTo(0, 0);
    } else {
      
      /*
      let elements_to_be_hidden = document.getElementsByClassName("omistuskirjoitus-popup-aria-hidden"),
        len = elements_to_be_hidden !== null ? elements_to_be_hidden.length : 0,
        i = 0;
      for(i; i < len; i++) {
          elements_to_be_hidden[i].setAttribute("aria-hidden","false"); 
      }
      */
      
      popup.classList.remove("active");
      document.querySelector('a.omistuskirjoitus-introduction').setAttribute("aria-expanded","false"); 
      document.querySelector('a.omistuskirjoitus-introduction').focus();
    }
  },
  toggleListenPopup: function() {
    let popup = document.getElementById("omistuskirjoitus-listen-popup");
    if(popup.classList.toggle("active")) {
      
      let elements_to_be_hidden = document.getElementsByClassName("omistuskirjoitus-popup-aria-hidden"),
        len = elements_to_be_hidden !== null ? elements_to_be_hidden.length : 0,
        i = 0;
      for(i; i < len; i++) {
          elements_to_be_hidden[i].setAttribute("aria-hidden","true"); 
      }
      
      let player = document.querySelector('#omistuskirjoitus-listen-popup audio');
      player.play();
      document.querySelector('a.omistuskirjoitus-listen').setAttribute("aria-expanded","true"); 
      popup.querySelector(".omistuskirjoitus-popup-close-btn").focus();
    } else {
      
      let elements_to_be_hidden = document.getElementsByClassName("omistuskirjoitus-popup-aria-hidden"),
        len = elements_to_be_hidden !== null ? elements_to_be_hidden.length : 0,
        i = 0;
      for(i; i < len; i++) {
          elements_to_be_hidden[i].setAttribute("aria-hidden","false"); 
      }
      
      let player = document.querySelector('#omistuskirjoitus-listen-popup audio');
      player.pause();
      document.querySelector('a.omistuskirjoitus-listen').setAttribute("aria-expanded","false"); 
      document.querySelector('a.omistuskirjoitus-listen').focus();
    }
  }
}
omistuskirjoitusScripts.words_element = document.getElementById('omistuskirjoitus-words');
omistuskirjoitusScripts.langs = Object.keys(omistuskirjoitusLangs.omistuskirjoitus_words);
omistuskirjoitusScripts.word_count = omistuskirjoitusLangs.omistuskirjoitus_words[omistuskirjoitusScripts.langs[0]].length;

for (let i = 0; i < omistuskirjoitusScripts.word_count; i++) {
  
  ++omistuskirjoitusScripts.count;
  ++omistuskirjoitusScripts.row;
  
  let word_html = '';
  let long_word = false;
  omistuskirjoitusScripts.langs.forEach(function(j) {
    let word = omistuskirjoitusLangs.omistuskirjoitus_words[j][i];
    if (word.length > 30) {
      long_word = true;
    }
    word_html += '<span lang="'+j+'">'+word+'</span>';
  });
  
  let random_place = 1;
  if (!long_word) {
    random_place = Math.floor(Math.random() * 10) + 1;
    if (random_place == omistuskirjoitusScripts.prev_random_place) random_place = Math.floor(Math.random() * 10) + 1;
    if (random_place == omistuskirjoitusScripts.prev_random_place) random_place++;
    if (random_place > 10) random_place = 1;
  }
  omistuskirjoitusScripts.prev_random_place = random_place;
  
  if (omistuskirjoitusScripts.row > omistuskirjoitusScripts.max_rows) omistuskirjoitusScripts.row = 1; 
  if (omistuskirjoitusScripts.row == 1) omistuskirjoitusScripts.html += '<div class="omistuskirjoitus-column">';
  omistuskirjoitusScripts.html += '<div class="omistuskirjoitus-word omistuskirjoitus-place-'+random_place+'">'+word_html+'</div>';
  if (omistuskirjoitusScripts.row == omistuskirjoitusScripts.max_rows) {
    omistuskirjoitusScripts.html += '</div>';
    omistuskirjoitusScripts.words_element.insertAdjacentHTML('beforeend', omistuskirjoitusScripts.html);
    omistuskirjoitusScripts.html = '';
  }
}

$('.omistuskirjoitus-langs a').click(function(e) {
  e.preventDefault();
  let lang = $(this).attr('lang');
  $('section.omistuskirjoitus').attr('lang',lang);
  //$('html').attr('lang',lang);
  history.pushState(null, '', '?'+omistuskirjoitusScripts.lang_key+'='+lang);
});

$(function() {
  const params = new URLSearchParams(window.location.search);
  if (params.has(omistuskirjoitusScripts.lang_key)) {
    const lang = params.get(omistuskirjoitusScripts.lang_key);
    $('section.omistuskirjoitus').attr('lang',lang);
  }
  else {
    let lang = $('html').attr('lang');
    if (lang) {
      lang = lang.substring(0,2);
      $('section.omistuskirjoitus').attr('lang',lang);
    }
    else {
      $('section.omistuskirjoitus').attr('lang','fi');
    }
  } 
});

$('a.omistuskirjoitus-introduction').click(function(e) {
  e.preventDefault();
  omistuskirjoitusScripts.togglePopup();
});
$('#omistuskirjoitus-introduction-popup-overlay').click(function(e) {
  omistuskirjoitusScripts.togglePopup();
});

$('a.omistuskirjoitus-listen').click(function(e) {
  e.preventDefault();
  omistuskirjoitusScripts.toggleListenPopup();
});
$('#omistuskirjoitus-listen-popup-overlay').click(function(e) {
  omistuskirjoitusScripts.toggleListenPopup();
});

