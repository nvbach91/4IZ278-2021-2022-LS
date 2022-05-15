import {LitElement, html, css} from 'lit';
import {customElement} from 'lit/decorators.js';

@customElement('ui-loading')
export class UILoading extends LitElement {
  static styles = css`
 :host {
  display: flex;
  height: 100%;
  width: 100%;
  align-items: center;
  justify-content: center;
}

.loading::before {
  margin: 0px;
  font-family: Cousine;
  font-size: 2.25rem;
  line-height: 2.5rem;
  font-weight: 900;
  content: "";
  animation: progress-text 2s steps(10) 0.5s 1 normal both;
}

.loading::after {
  content: "";
  margin-left: 4px;
  height: 5px;
  width: 20px;
  display: inline-block;
  animation: cursor-blink 500ms steps(2, end) infinite normal;
}


@keyframes cursor-blink {
  0% {
    background-color: rgb(34 94 97);
  }

  49% {
    background-color: rgb(34 94 97);
  }

  50% {
    background-color: transparent;
  }

  100% {
    background-color: transparent;
  }
}

  @media (prefers-color-scheme: dark) {
      @keyframes cursor-blink {
      0% {
        background-color: rgb(135 207 120);
      }

      49% {
        background-color: rgb(135 207 120);
      }

      50% {
        background-color: transparent;
      }

      100% {
        background-color: transparent;
      }
    }
  }


@keyframes progress-text {
  from {
    content: "";
  }

  10% {
    content: "L";
  }

  20% {
    content: "LO";
  }

  30% {
    content: "LOA";
  }

  40% {
    content: "LOAD";
  }

  50% {
    content: "LOADI";
  }

  60% {
    content: "LOADING";
  }

  70% {
    content: "LOADING.";
  }

  72% {
    content: "LOADING..";
  }

  100% {
    content: "LOADING...";
  }

  to {
    content: "LOADING...";
  }
}
`;

  protected render() {
    return html`
      <h1 class=${"loading"}></h1>
    `;
  }
}
