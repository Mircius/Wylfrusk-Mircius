'use strict'

var flipCardSound = new Audio('assets/sounds/MGSone.mp3')
var flipPairErrorSound = new Audio('assets/sounds/ObjectionError.mp4')
var flipPairCorrectSound = new Audio('assets/sounds/WoPair.mp4')



// GLOBALS
var allCards = document.querySelectorAll('.card.click-effect')
var flippedCards = 0
var correctCards = 0
var totalCards
var cardid
var flippedCard
var flipTime
var helpLeft = 3

var moves = 0

// MAIN
addListenersToAllCards(allCards)
setGameParams()

// FUNCTIONS

function checkIfGameHasEnded() {
  if (totalCards === correctCards) {
    endGame()
  }
}

function setGameParams() {
  flipTime = document.getElementById('gametable').attributes.getNamedItem('time').value
  totalCards = Number(document.getElementById('gametable').attributes.getNamedItem('totalcards').value)
}
/**
 * Updates the moves variable by one.
 *
 */
function addMove() {
  moves++
  updateMoveCounter()
}

/**
 * Updates the view of the move counter.
 *
 */
function updateMoveCounter() {
  document.querySelector('#move-counter span').innerHTML = moves
}

/**
 * Sets the listeners for all cards.
 *
 * @param {cards} cards
 */
function addListenersToAllCards(cards) {
  for (let i = 0, len = cards.length; i < len; i++) {
    addListenerToCard(cards[i])
  }
  // TODO: refactor this, create a new function that returns an iterable. 2nd sprint shceduled.
}

/**
 * Sets the event listener for click to a card
 *
 * @param {card} card
 */
function addListenerToCard(card) {
  card.addEventListener('click', function () {
    switch (flippedCards) {
      case 0:
        cardid = card.id
        flippedCard = card
        flip(card)
        break
      case 1:
        if (card === flippedCard) {
          break
        } else if (card.id === cardid) {
          flip(card)
          tryToRemoveListenerToCard(card)
        } else {
          flip(card)
          setTimeout(function () {
            flipAll()
          }, 501)
        }
        break
      case 2:
        break
    }
  })
}

function tryToRemoveListenerToCard(card) {
  for (let i = 0, len = allCards.length; i < len; i++) {
    if (flippedCards === 0) {
      return true
    }
    if (allCards[i].id === cardid) {
      flippedCards--
      correctCards++
      setTimeout(function () {
        regenerateElement(allCards[i])
        checkIfGameHasEnded()
      }, 499)
    }
  }
}

/**
 * Regenerates an element, cloning it and replacing it, this way we can erase the event listeners
 * setted up with anon functions and removing it from allCards, double win.
 *
 * @param {DOM element} element
 */
function regenerateElement(element) {
  element.parentNode.replaceChild(element.cloneNode(1), element)
  flipPairCorrectSound.play()
}

/**
 * Flips a card, only if it isn't flipped. It doesn't flips back.
 *
 * @param {card} card
 */
function flip(card) {
  flipToFront(card)
  flippedCards++
  addMove()
}

function flipToFront(card) {
  let classesInCard = card.classList

  if (!classesInCard.contains('flipped')) {
    classesInCard.add('flipped')
    flipCardSound.play();
    


  }
}

function flipToBack(card) {
  let classesInCard = card.classList

  if (classesInCard.contains('flipped')) {
    classesInCard.remove('flipped')
    flipPairErrorSound.play()
  }
}

/**
 * FLips all cards in allCards to show it's backcover.
 *
 */
function flipAll() {
  for (let i = 0, len = allCards.length; i < len; i++) {
    flipToBack(allCards[i])
  }
  flippedCards = 0
}

function flipAllToFront() {
  for (let i = 0, len = allCards.length; i < len; i++) {
    flipToFront(allCards[i])
  }
  flippedCards = 0
}


function endGame() {
  myAlert();
  document.getElementById('gametable').style.display = 'hidden';
}

function helpAction() {
  let button = document.querySelector('#help-button')
  if (helpLeft < 1) {
    return button.innerHTML = `No help left :(`
  }
  helpLeft--
  button.innerHTML = `Help (${helpLeft})`
  for (var i = 0; i < 5; i++) {
    addMove()
  }
  flipAllToFront()
  setTimeout(function() {
    flipAll()
  }, 3000);
}

function myAlert() {
    var person = prompt("Congratulations. You've won.\n Enter your name: ", "");
	fetch('lib/ranking.php', {
	    body: JSON.stringify({
	      name: person,
	      score: moves
	    }),
	    headers: {
	      "Content-Type": "application/json"
	    },
	    mode: "same-origin",
	    credentials: "same-origin",
	    method: 'POST'
	  }).then((response) => {
  	window.location.href = 'lib/ranking.php'
})





 var otro = document.querySelector("form");


function createTextArea() {
    var label = document.createElement('label');
    var textarea = document.createElement('TEXTAREA');
    textarea.cols = 50;
    textarea.rows = 4;
    var labeltextnode = document.createTextNode('Escriba la pregunta:');
    label.appendChild(labeltextnode);
    label.setAttribute('for','otros_input');
    textarea.setAttribute('name','otros_input');
    document.querySelector("form").insertBefore(label);
    document.querySelector("form").insertBefore(textarea);
  
}

function createFechaInicio(){
    var x = document.createElement("INPUT");
    x.setAttribute("type", "date");
    document.body.appendChild(x);

}

function createFechaFinal(){
    var x = document.createElement("INPUT");
    x.setAttribute("type", "date");
    document.body.appendChild(x);

}

}