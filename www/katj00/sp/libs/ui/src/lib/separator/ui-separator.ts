import {LitElement, html, css} from 'lit';
import {customElement} from 'lit/decorators.js';

@customElement('ui-separator')
export class UiSeparator extends LitElement {
  static styles = css`
 .separator {
    font-family: inherit;
    font-size: inherit;
    font-weight: black;
    line-height: inherit;
 }
`;

  protected render() {
    return html`
      <span class=${"separator"}>&centerdot;</span>
    `;
  }
}
