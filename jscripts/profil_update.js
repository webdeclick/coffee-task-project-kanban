var _createClass = function () { function defineProperties(target, props) { for (var i = 0; i < props.length; i++) {if (window.CP.shouldStopExecution(1)){break;}if (window.CP.shouldStopExecution(1)){break;} var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); }
window.CP.exitedLoop(1);
console.log("test");
window.CP.exitedLoop(1);
 } return function (Constructor, protoProps, staticProps) { if (protoProps) defineProperties(Constructor.prototype, protoProps); if (staticProps) defineProperties(Constructor, staticProps); return Constructor; }; }();

function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

function _possibleConstructorReturn(self, call) { if (!self) { throw new ReferenceError("this hasn't been initialised - super() hasn't been called"); } return call && (typeof call === "object" || typeof call === "function") ? call : self; }

function _inherits(subClass, superClass) { if (typeof superClass !== "function" && superClass !== null) { throw new TypeError("Super expression must either be null or a function, not " + typeof superClass); } subClass.prototype = Object.create(superClass && superClass.prototype, { constructor: { value: subClass, enumerable: false, writable: true, configurable: true } }); if (superClass) Object.setPrototypeOf ? Object.setPrototypeOf(subClass, superClass) : subClass.__proto__ = superClass; }

var cardContainer = document.querySelector('.profil_form');

// React component for form inputs

var CardInput = function (_React$Component) {
  _inherits(CardInput, _React$Component);

  function CardInput() {
    _classCallCheck(this, CardInput);

    return _possibleConstructorReturn(this, (CardInput.__proto__ || Object.getPrototypeOf(CardInput)).apply(this, arguments));
  }

  _createClass(CardInput, [{
    key: 'render',
    value: function render() {
      return React.createElement(
        'fieldset',
        null,
        React.createElement('input', { name: this.props.name, id: this.props.id, type: this.props.type || 'text', placeholder: this.props.placeholder, required: true })
      );
    }
  }]);

  return CardInput;
}(React.Component);

// React component for textarea


var CardTextarea = function (_React$Component2) {
  _inherits(CardTextarea, _React$Component2);

  function CardTextarea() {
    _classCallCheck(this, CardTextarea);

    return _possibleConstructorReturn(this, (CardTextarea.__proto__ || Object.getPrototypeOf(CardTextarea)).apply(this, arguments));
  }

  _createClass(CardTextarea, [{
    key: 'render',
    value: function render() {
      return React.createElement(
        'fieldset',
        null,
        React.createElement('textarea', { name: this.props.name, id: this.props.id, placeholder: this.props.placeholder, required: true })
      );
    }
  }]);

  return CardTextarea;
}(React.Component);

// React component for form button


var CardBtn = function (_React$Component3) {
  _inherits(CardBtn, _React$Component3);

  function CardBtn() {
    _classCallCheck(this, CardBtn);

    return _possibleConstructorReturn(this, (CardBtn.__proto__ || Object.getPrototypeOf(CardBtn)).apply(this, arguments));
  }

  _createClass(CardBtn, [{
    key: 'render',
    value: function render() {
      return React.createElement(
        'fieldset',
        null,
        React.createElement(
          'button',
          { className: this.props.className, type: this.props.type, value: this.props.value },
          this.props.value
        )
      );
    }
  }]);

  return CardBtn;
}(React.Component);

// React component for social profile links


var CardProfileLinks = function (_React$Component4) {
  _inherits(CardProfileLinks, _React$Component4);

  function CardProfileLinks() {
    _classCallCheck(this, CardProfileLinks);

    return _possibleConstructorReturn(this, (CardProfileLinks.__proto__ || Object.getPrototypeOf(CardProfileLinks)).apply(this, arguments));
  }

  _createClass(CardProfileLinks, [{
    key: 'render',
    value: function render() {
      var profileLinks = ['twitter', 'linkedin', 'dribbble', 'facebook'];

      var linksList = profileLinks.map(function (link, index) {
        return React.createElement(
          'li',
          { key: index },
          React.createElement(
            'a',
            { href: '#' },
            React.createElement('i', { className: 'fa fa-' + link })
          )
        );
      });

      return React.createElement(
        'div',
        { className: 'card-social-links' },
        React.createElement(
          'ul',
          { className: 'social-links' },
          linksList
        )
      );
    }
  }]);

  return CardProfileLinks;
}(React.Component);

// React component for the front side of the card


var CardFront = function (_React$Component5) {
  _inherits(CardFront, _React$Component5);

  function CardFront() {
    _classCallCheck(this, CardFront);

    return _possibleConstructorReturn(this, (CardFront.__proto__ || Object.getPrototypeOf(CardFront)).apply(this, arguments));
  }

  _createClass(CardFront, [{
    key: 'render',
    value: function render() {
      return React.createElement(
        'div',
        { className: 'card-side side-front' },
        React.createElement(
          'div',
          { className: 'container-fluid' },
          React.createElement(
            'div',
            { className: 'row' },
            React.createElement(
              'div',
              { className: 'col-xs-6' },
              React.createElement('img', { src: 'https://source.unsplash.com/w8YICpz1I10/358x458' })
            ),
            React.createElement(
              'div',
              { className: 'col-xs-6 side-front-content' },
              React.createElement(
                'h2',
                null,
                'Czech based'
              ),
              React.createElement(
                'h1',
                null,
                'UI/UX Designer'
              ),
              React.createElement(
                'p',
                null,
                'Andrey is driven by turning ideas into scalable and and empowering experiences that solve real life problems.'
              ),
              React.createElement(
                'p',
                null,
                'He is currently the founder of Dvorak Media. Previously, Andrey was a product designer at Dropbox.'
              ),
              React.createElement(
                'p',
                null,
                'Over the years, Michael has been priviledged to have worked with Adobe, Evernote, Square and more.'
              )
            )
          )
        )
      );
    }
  }]);

  return CardFront;
}(React.Component);

// React component for the back side of the card


var CardBack = function (_React$Component6) {
  _inherits(CardBack, _React$Component6);

  function CardBack() {
    _classCallCheck(this, CardBack);

    return _possibleConstructorReturn(this, (CardBack.__proto__ || Object.getPrototypeOf(CardBack)).apply(this, arguments));
  }

  _createClass(CardBack, [{
    key: 'render',
    value: function render() {
      return React.createElement(
        'div',
        { className: 'card-side side-back' },
        React.createElement(
          'div',
          { className: 'container-fluid' },
          React.createElement(
            'h1',
            null,
            'Let\'s get in touch!'
          ),
          React.createElement(
            'form',
            { formAction: '', className: 'card-form' },
            React.createElement(
              'div',
              { className: 'row' },
              React.createElement(
                'div',
                { className: 'col-xs-6' },
                React.createElement(CardInput, { name: 'contactFirstName', id: 'contactFirstName', type: 'text', placeholder: 'Your first name' })
              ),
              React.createElement(
                'div',
                { className: 'col-xs-6' },
                React.createElement(CardInput, { name: 'contactLastName', id: 'contactLastName', type: 'text', placeholder: 'Your last name' })
              )
            ),
            React.createElement(
              'div',
              { className: 'row' },
              React.createElement(
                'div',
                { className: 'col-xs-6' },
                React.createElement(CardInput, { name: 'contactEmail', id: 'contactEmail', type: 'email', placeholder: 'Your email address' })
              ),
              React.createElement(
                'div',
                { className: 'col-xs-6' },
                React.createElement(CardInput, { name: 'contactSubject', id: 'contactSubject', type: 'text', placeholder: 'Subject' })
              )
            ),
            React.createElement(CardTextarea, { name: 'contactMessage', id: 'contactMessage', placeholder: 'Your message' }),
            React.createElement(CardBtn, { className: 'btn btn-primary', type: 'submit', value: 'Send message' })
          ),
          React.createElement(CardProfileLinks, null)
        )
      );
    }
  }]);

  return CardBack;
}(React.Component);

// React component for the card (main component)


var Card = function (_React$Component7) {
  _inherits(Card, _React$Component7);

  function Card() {
    _classCallCheck(this, Card);

    return _possibleConstructorReturn(this, (Card.__proto__ || Object.getPrototypeOf(Card)).apply(this, arguments));
  }

  _createClass(Card, [{
    key: 'render',
    value: function render() {
      return React.createElement(
        'div',
        { className: 'card-container' },
        React.createElement(
          'div',
          { className: 'card-body' },
          React.createElement(CardBack, null),
          React.createElement(CardFront, null)
        )
      );
    }
  }]);

  return Card;
}(React.Component);

// Render Card component


ReactDOM.render(React.createElement(Card, null), cardContainer);