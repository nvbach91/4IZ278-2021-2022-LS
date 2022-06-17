import {LitElement, html, css} from 'lit';
import {customElement} from 'lit/decorators.js';

@customElement('ui-synchronizing')
export class UISynchronizing extends LitElement {
  static styles = css`
 :host {
  display: flex;
  height: 100%;
  width: 100%;
  align-items: center;
  justify-content: center;
}

.synchronizing::before {
  margin: 0px;
  font-family: Cousine;
  font-size: 2.25rem;
  line-height: 2.5rem;
  font-weight: 900;
  content: "";
  animation: progress-text 3s steps(16) 0.5s 1 normal both;
}

.synchronizing::after {
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

  5% {
    content: "S";
  }

  10% {
    content: "SY";
  }

  15% {
    content: "SYN";
  }

  20% {
    content: "SYNC";
  }

  30% {
    content: "SYNCH";
  }

  40% {
    content: "SYNCHR";
  }

  50% {
    content: "SYNCHRO";
  }

  60% {
    content: "SYNCHRON";
  }

  65% {
    content: "SYNCHRONIZ";
  }
  70% {
    content: "SYNCHRONIZI";
  }
  80% {
    content: "SYNCHRONIZIN";
  }
  85% {
    content: "SYNCHRONIZING";
  }
  90% {
    content: "SYNCHRONIZING.";
  }
  100% {
    content: "SYNCHRONIZING...";
  }
  to {
    content: "SYNCHRONIZING...";
  }
}
`;

  protected render() {
    return html`
      <h1 class=${"synchronizing"}></h1>
    `;
  }
}
