class ReviewCard extends HTMLElement {
    constructor() {
      super();
  
      this.name = this.getAttribute("name") || "Name";
      this.username = this.getAttribute("username") || "@username";
      this.content = this.getAttribute("content") || "Lorem ipsum dolor dae.";
      this.avatar = this.getAttribute("avatar");
  
      this.attachShadow({ mode: "open" });
    }
  
    connectedCallback() {
      this.render();
    }
  
    render() {
      this.shadowRoot.innerHTML = `
        <style>${ReviewCard.styles}</style>
        <figure class="card-container">
          <div class="header">
            <img class="avatar" width="32" height="32" alt="${this.name}" src="${this.avatar}" />
            <div class="user">
              <figcaption class="name">${this.name}</figcaption>
              <p class="username">${this.username}</p>
            </div>
          </div>
          <blockquote class="content">${this.content}</blockquote>
        </figure>
      `;
    }
  
    static get styles() {
      return `
        * {
          border: 0;
          margin: 0;
          padding: 0;
          box-sizing: border-box;
        }
  
        .card-container {
          color: #fff;
          width: var(--card-width, 16rem);
          height: 100%;
          padding: 1rem;
          cursor: pointer;
          overflow: hidden;
          position: relative;
          border-radius: 0.75rem;
          font-family: sans-serif;
          border: 1px solid #0c0c3e;
          background-color: #0c0c3e;
  
          transition: background-color 0.3s ease-in-out;
  
          &:hover {
            background-color: #0c0c3e;
          }
  
          & .header {
            gap: 0.5rem;
            display: flex;
            align-items: center;
  
            & .avatar {
              border-radius: 9999px;
            }
  
            & .user {
              display: flex;
              flex-direction: column;
  
              & .name {
                font-weight: 500;
                font-size: 0.875rem;
                line-height: 1.25rem;
              }
  
              & .username {
                font-weight: 500;
                line-height: 1rem;
                font-size: 0.75rem;
                text-transform: lowercase;
                color: rgb(255 255 255 / 0.4)
              }
            }
          }
  
          & .content {
            font-size: 0.875rem;
            line-height: 1.25rem;
            margin-block-start: 0.5rem;
          }
        }
      `;
    }
  }
  
  customElements.define("review-card", ReviewCard);
   