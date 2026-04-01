// ----------------------------------- Les constantes tirées d'elements

const inputRechercher = document.querySelector("#inputRechercher");
const buttonRechercher = document.querySelector("#buttonRechercher");
const leBoutonGo = document.querySelector(".bouttonGo");
const outputNewLetter = document.querySelector("#outputNewLetter");
const trainNewLetter = document.querySelector("#trainNewLetter");
const tousLesConteneurs = document.querySelectorAll(".fondBouttonNav");
const divAPI = document.getElementById("API");

// Utilisation d'un try/catch pour éviter que le script plante si le localStorage est corrompu
let messageTab = [];
try {
  messageTab = JSON.parse(localStorage.getItem("info_message")) || [];
} catch (e) {
  messageTab = [];
}

// -----------------------------------simulation de base de donées
const pagesDuSite = [
  {
    nom: "Accueil",
    url: "index.php?page=accueil",
    contenu: "Bonjour Voyageur Je suis Lorthan l’Insaisissable...",
  },
  {
    nom: "PROFIL",
    url: "index.php?page=Profil",
    contenu: "Veuillez vous connecter pour voir vos items...",
  },
  {
    nom: "Tresor",
    url: "index.php?page=tresor",
    contenu: "Veuillez vous connecter pour avoir access au quete...",
  },
  {
    nom: "Boutique",
    url: "index.php?page=boutique",
    contenu: "Boutique parchemin achat",
  },
  {
    nom: "Option",
    url: "index.php?page=option",
    contenu: "Adhérer à la newsletter",
  },
  {
    nom: "Contact",
    url: "index.php?page=contact",
    contenu: "formulaire de contact. envoyer message",
  },
  {
    nom: "inscription",
    url: "index.php?page=inscription",
    contenu: "inscription",
  },
  {
    nom: "panier",
    url: "index.php?page=panier",
    contenu: "panier total payer",
  },
];

// ---------------------------------------ensemble de fonction

async function recupererPersonnageHP() {
  if (!divAPI) return; // Sécurité : on sort si la div API n'est pas sur la page

  try {
    const result = await fetch("https://hp-api.onrender.com/api/characters");
    const personnagesListe = await result.json();
    let personnagesdefault = 0;

    const container = document.createElement("div");
    container.classList.add("api-main-container");
    container.style.display = "flex";
    container.style.alignItems = "center";

    let bouttonGauche = document.createElement("button");
    bouttonGauche.innerText = "⏴";

    let caseDuMilieu = document.createElement("div");
    caseDuMilieu.id = "caseDuMilieu";
    caseDuMilieu.style.textAlign = "center";

    let nomPersonnage = document.createElement("h2");
    let imagePersonnage = document.createElement("img");
    imagePersonnage.style.height = "300px";
    imagePersonnage.style.width = "200px";
    imagePersonnage.style.objectFit = "cover";

    // Gestion de l'erreur image
    imagePersonnage.onerror = () => {
      imagePersonnage.src = "image/chatsecoure.png";
    };

    let positionPersonnage = document.createElement("p");
    let search = document.createElement("input");
    search.placeholder = "Entrez nom rechercher";

    let bouttonDroite = document.createElement("button");
    bouttonDroite.innerText = "⏵";

    const majAffichage = () => {
      const p = personnagesListe[personnagesdefault];
      nomPersonnage.innerText = p.name;
      imagePersonnage.src = p.image || "image/chatsecoure.png";
      positionPersonnage.innerText = `${personnagesdefault + 1} / ${personnagesListe.length}`;
      bouttonGauche.disabled = personnagesdefault === 0;
      bouttonDroite.disabled =
        personnagesdefault === personnagesListe.length - 1;
    };

    bouttonGauche.onclick = () => {
      personnagesdefault--;
      majAffichage();
    };
    bouttonDroite.onclick = () => {
      personnagesdefault++;
      majAffichage();
    };

    // Ajout à la page
    caseDuMilieu.append(
      nomPersonnage,
      imagePersonnage,
      positionPersonnage,
      search,
    );
    container.append(bouttonGauche, caseDuMilieu, bouttonDroite);
    divAPI.appendChild(container);

    majAffichage();
  } catch (error) {
    console.error("Erreur API HP:", error);
  }
}

function receptionRecherche() {
  if (leBoutonGo && inputRechercher) {
    leBoutonGo.addEventListener("click", lancerRecherche);
    inputRechercher.addEventListener("keydown", (event) => {
      if (event.key === "Enter") lancerRecherche();
    });
  }
}

function lancerRecherche() {
  if (!inputRechercher) return;
  const motCherche = inputRechercher.value.toLowerCase();
  const resultats = pagesDuSite.filter((page) =>
    page.contenu.toLowerCase().includes(motCherche),
  );

  if (resultats.length > 0) {
    window.location.href = resultats[0].url;
  } else {
    alert("Désolé, aucune page ne contient ce mot.");
  }
}

function sortieDeClef() {
  if (tousLesConteneurs.length === 0) return;
  tousLesConteneurs.forEach((nav) => {
    const clef = nav.querySelector(".clef");
    const bouttonNav = nav.querySelector(".bouttonNav");
    if (bouttonNav && clef) {
      bouttonNav.addEventListener("mouseover", () => {
        clef.style.marginLeft = "200px";
      });
      bouttonNav.addEventListener("mouseleave", () => {
        clef.style.marginLeft = "0px";
      });
    }
  });
}

// -------------------------------------- Séquence Main (Lancement au chargement)
document.addEventListener("DOMContentLoaded", () => {
  sortieDeClef();
  receptionRecherche();
  recupererPersonnageHP();
});
