let revealObserver = null;

function observeReveals(root) {
  if (!revealObserver || !root) return;
  root.querySelectorAll(".section-head, .fact, .indicator-card, .card, .prose, .notes, .submission-form, .submission-card").forEach(function (element, index) {
    if (element.classList.contains("reveal")) return;
    element.classList.add("reveal");
    if (element.classList.contains("card")) {
      element.style.setProperty("--reveal-delay", Math.min(index % 4, 3) * 70 + "ms");
    }
    revealObserver.observe(element);
  });
}

const DESTINATIONS = [
  {
    id: "palabuhanratu",
    name: "Palabuhanratu Beach",
    category: "beach",
    district: "Palabuhanratu District",
    summary: "The main bay on the regency's southern coast and the seat of local government. Fishing boats, a working fish port and long sunsets give the waterfront its character.",
    highlights: ["Fishing port and seafood stalls", "Sunset views over the Indian Ocean", "Close to other coastal and geopark sites"],
    bestFor: "Day trips and seafood",
    tip: "Currents on this coast can be strong. Swim only where local guides or lifeguards say it is safe."
  },
  {
    id: "karang-hawu",
    name: "Karang Hawu Beach",
    category: "beach",
    district: "Cisolok District",
    summary: "A rocky headland where large waves break against dark boulders. It is better known for its viewpoints and photography than for swimming.",
    highlights: ["Dramatic rock and wave scenery", "Viewpoints along the cliff", "Cisolok hot springs nearby"],
    bestFor: "Photography and scenery",
    tip: "Rocks are slippery when wet. Wear shoes with good grip and keep back from the edge in high surf."
  },
  {
    id: "palangpang",
    name: "Palangpang Beach",
    category: "beach",
    district: "Ciemas District",
    summary: "A wide bay at the foot of the Ciletuh Geopark cliffs, and a common starting point for exploring the geopark.",
    highlights: ["Broad bay with space to walk", "Cliff and ridge backdrop", "Access to the Panenjoan viewpoint and waterfalls"],
    bestFor: "Families and geopark visitors",
    tip: "Distances between geopark sites are long. Plan them as one route rather than separate trips."
  },
  {
    id: "ujung-genteng",
    name: "Ujung Genteng",
    category: "beach",
    district: "Ciracap District",
    summary: "A remote coastal community at the far southwestern tip of the regency, known for its lighthouse and sea turtle conservation efforts.",
    highlights: ["Lighthouse and coastline views", "Sea turtle nesting at nearby Pangumbahan", "Quiet beaches away from the main towns"],
    bestFor: "Long weekends",
    tip: "It is a long drive from the main towns. Arrange transport and lodging in advance."
  },
  {
    id: "cikaso",
    name: "Cikaso Waterfall",
    category: "waterfall",
    district: "Surade District",
    summary: "A wide waterfall that spills down in three streams. Visitors can reach it with a short boat ride along the river.",
    highlights: ["Three parallel falls", "Boat ride along the river", "Green river valley scenery"],
    bestFor: "Nature lovers and photographers",
    tip: "River levels rise after heavy rain. Check conditions before taking the boat."
  },
  {
    id: "sodong",
    name: "Sodong Waterfall",
    category: "waterfall",
    district: "Ciletuh Geopark area",
    summary: "A forested waterfall within the Ciletuh Geopark landscape, easy to combine with the geopark's viewpoints.",
    highlights: ["Forest setting", "Part of the geopark route", "A natural stop between viewpoints"],
    bestFor: "Short nature stops",
    tip: "Paths can be muddy. Bring water and wear sturdy shoes."
  },
  {
    id: "ciletuh",
    name: "Ciletuh-Palabuhanratu Geopark",
    category: "nature",
    district: "Ciemas District and surroundings",
    summary: "A landscape of ancient rock, cliffs, a horseshoe-shaped bay and waterfalls. It was designated a UNESCO Global Geopark in 2018.",
    highlights: ["Panenjoan viewpoint over the bay", "Geological sites with ancient rock formations", "Waterfalls and beaches in one area"],
    bestFor: "Learning and sightseeing",
    tip: "Allow a full day or more. The sites are spread out."
  },
  {
    id: "situ-gunung",
    name: "Situ Gunung",
    category: "nature",
    district: "Kadudampit District",
    summary: "A lake and forest area at the foot of Mount Gede Pangrango, known for its long suspension bridge and cooler air.",
    highlights: ["Suspension bridge through the forest", "Lake and forest paths", "Cool highland climate"],
    bestFor: "Families and hikers",
    tip: "Mornings are usually clearer. Weekends can be crowded."
  }
];

const CATEGORY_LABEL = { beach: "Beach", waterfall: "Waterfall", nature: "Nature" };

function commonsPhotos(folder, entries) {
  return entries.map(function (entry) {
    return {
      src: "images/destinations/" + folder + "/" + entry[0],
      title: entry[1],
      author: entry[2],
      license: entry[3],
      source: "https://commons.wikimedia.org/wiki/File:" + encodeURIComponent(entry[4].replace(/ /g, "_"))
    };
  });
}

const DESTINATION_PHOTOS = {
  palabuhanratu: commonsPhotos("palabuhanratu", [
    ["sunset-bay.jpg", "A view across Palabuhanratu Bay", "Hiroshi sanjuro", "CC BY-SA 4.0", "A Beautiful Beach At Pelabuhan Ratu, Sukabumi, West Java, Indonesia.jpg"],
    ["coast-walk.jpg", "Walking along the Palabuhanratu coast", "Hiroshi sanjuro", "CC BY-SA 4.0", "Beach Walking at Pelabuhan Ratu, Sukabumi, West Java, Indonesia.jpg"],
    ["pelabuhan-ratu-beach.jpg", "Pelabuhan Ratu beach", "Midori", "CC BY 3.0", "Pelabuhan Ratu beach.jpg"]
  ]),
  "karang-hawu": commonsPhotos("karang-hawu", [
    ["karang-hawu-headland.jpg", "Karang Hawu headland", "Hiroshi sanjuro", "CC BY-SA 4.0", "Karang Hawu, Pelabuhan Ratu, Sukabumi, Jawa Barat.jpg"],
    ["karang-hawu-coast.jpg", "Karang Hawu coastline", "Hiroshi sanjuro", "CC BY-SA 4.0", "Pantai Karang Hawu, Pelabuhan Ratu, Sukabumi, Jawa Barat.jpg"],
    ["karanghawu-beach.jpg", "Karanghawu Beach", "Midori", "CC BY 3.0", "Karanghawu Beach.jpg"]
  ]),
  palangpang: commonsPhotos("palangpang", [
    ["palangpang-beach-2022.jpg", "Palangpang Beach in 2022", "Afrogindahood", "CC BY-SA 4.0", "Palangpang Beach in 2022.jpg"]
  ]),
  "ujung-genteng": commonsPhotos("ujung-genteng", [
    ["ujung-genteng-coast.jpg", "Ujung Genteng coastline", "Diazhollic", "CC BY-SA 4.0", "Ujung genteng.jpg"],
    ["ujung-genteng-beach.jpg", "Ujung Genteng beach", "Raffiakbar29", "CC BY-SA 4.0", "Pantai Ujung Genteng, Sukabumi, Jawa Barat, 25052017.jpg"],
    ["pangumbahan-turtle-hatchery.jpg", "Green turtle hatchlings at Pangumbahan", "Raffiakbar29", "CC BY-SA 4.0", "Tukik penyu hijau, Penangkaran Penyu Pangumbahan Ujung Genteng, Sukabumi, 25052017.jpg"],
    ["ujung-genteng-turtle.jpg", "Green turtle hatchlings near Ujung Genteng", "Raffiakbar29", "CC BY-SA 4.0", "Tukik penyu hijau, pantai Ujung Genteng, Sukabumi, 25052017.jpg"]
  ]),
  cikaso: commonsPhotos("cikaso", [
    ["cikaso-waterfall.jpg", "Cikaso waterfall", "Fajar.andunisy", "CC BY-SA 3.0", "Air terjun Cikaso.jpg"],
    ["curug-cikaso.jpg", "The three streams of Curug Cikaso", "Kerildoank", "CC BY-SA 4.0", "Beauty of Curug Cikaso (cikaso waterfall).jpg"],
    ["cikaso-falls.jpg", "Cikaso Waterfall", "Gink Abay", "CC BY-SA 4.0", "Cikaso Waterfall.jpg"],
    ["curug-cikaso-sukabumi.jpg", "Curug Cikaso, Sukabumi", "Mahmur marganti", "CC BY-SA 3.0", "Curug Cikaso, Sukabumi.jpg"]
  ]),
  sodong: commonsPhotos("sodong", [
    ["sodong-waterfalls.jpg", "Sodong Waterfalls", "Dede Arief", "CC BY-SA 4.0", "Sodong Waterfalls and the fam.jpg"],
    ["curug-sodong.jpg", "Curug Sodong, Ciletuh", "Aavisena", "CC BY-SA 4.0", "Curug Sodong, Ciletuh.jpg"],
    ["keindahan-curug-sodong.jpg", "Curug Sodong", "Irhanz", "CC BY-SA 4.0", "Keindahan Curug Sodong.jpg"]
  ]),
  ciletuh: commonsPhotos("ciletuh", [
    ["ciletuh-amphitheater-01.jpg", "Ciletuh Amphitheater, view 1", "Afrogindahood", "CC BY-SA 4.0", "Ciletuh Amphitheater seen from Tamanjaya 2022 01.jpg"],
    ["ciletuh-amphitheater-02.jpg", "Ciletuh Amphitheater, view 2", "Afrogindahood", "CC BY-SA 4.0", "Ciletuh Amphitheater seen from Tamanjaya 2022 02.jpg"],
    ["ciletuh-panorama.jpg", "Panorama of Ciletuh Geopark", "Sanggani geogeo", "CC BY-SA 4.0", "Panorama Amfiteater Geopark Ciletuh.jpg"],
    ["ciletuh-coast.jpg", "Ciletuh Geopark coastline", "BastianKyle", "CC BY-SA 4.0", "Taman Laut Geopark Ciletuh Sukabumi.jpg"]
  ]),
  "situ-gunung": commonsPhotos("situ-gunung", [
    ["suspension-bridge.jpg", "Situ Gunung suspension bridge", "Reni Kusmiawati212", "CC BY-SA 4.0", "Jembatan Gantung Situ Gunung Sukabumi.jpg"],
    ["situ-gunung-lake.jpg", "Situ Gunung lake", "Resti Rian Permatasari", "CC BY-SA 4.0", "Keindahan Situ Gunung Kabupaten Sukabumi.jpg"],
    ["situ-gunung-morning.jpg", "Morning at Situ Gunung", "Kerildoank", "CC BY-SA 4.0", "Morning at Situ Gunung.jpg"],
    ["situ-gunung-lake-view.jpg", "Lake scenery at Situ Gunung", "Rizal Muhaemin 3", "CC BY-SA 4.0", "Pemandangan alam danau situ gunung.jpg"]
  ])
};

// Destination cards use images/<id>.jpg; the details view also includes credited gallery photos.
DESTINATIONS.forEach(function (d) {
  d.image = "images/" + d.id + ".jpg";
  d.photos = [{ src: d.image, title: "Featured photo" }].concat(DESTINATION_PHOTOS[d.id] || []);
});

function mediaHTML(d) {
  return '<img src="' + d.image + '" alt="' + d.name + '" loading="lazy" ' +
    'onerror="useScene(this,\'' + d.category + '\')">';
}

function useScene(img, category) {
  img.parentNode.innerHTML = SCENES[category];
}

// Simple illustrated scenes, one per category (no external images needed).
const SCENES = {
  beach:
    '<svg viewBox="0 0 320 160" preserveAspectRatio="xMidYMid slice" aria-hidden="true">' +
    '<rect width="320" height="160" fill="#d3e7ee"/>' +
    '<circle cx="236" cy="62" r="24" fill="#e8b550"/>' +
    '<rect y="82" width="320" height="50" fill="#1b6f8a"/>' +
    '<path d="M0 98q20-8 40 0t40 0 40 0 40 0 40 0 40 0 40 0 40 0" fill="none" stroke="#fff" stroke-opacity=".55" stroke-width="2"/>' +
    '<path d="M0 114q20-8 40 0t40 0 40 0 40 0 40 0 40 0 40 0 40 0" fill="none" stroke="#fff" stroke-opacity=".35" stroke-width="2"/>' +
    '<path d="M0 160V132q80-14 160-4t160-2V160Z" fill="#e6d3a3"/>' +
    '</svg>',
  waterfall:
    '<svg viewBox="0 0 320 160" preserveAspectRatio="xMidYMid slice" aria-hidden="true">' +
    '<rect width="320" height="160" fill="#dcebdf"/>' +
    '<path d="M0 0H120V92H0Z" fill="#2f6b3f"/>' +
    '<path d="M200 0H320V92H200Z" fill="#24543a"/>' +
    '<rect x="120" y="0" width="80" height="96" fill="#cfe0d4"/>' +
    '<g fill="#fff" fill-opacity=".9"><rect x="134" y="10" width="10" height="84" rx="5"/><rect x="154" y="4" width="12" height="90" rx="6"/><rect x="176" y="12" width="10" height="82" rx="5"/></g>' +
    '<ellipse cx="160" cy="118" rx="110" ry="26" fill="#1b6f8a"/>' +
    '<path d="M0 160V132q60-14 120-8v36Z" fill="#24543a"/>' +
    '<path d="M320 160V132q-60-14-120-8v36Z" fill="#2f6b3f"/>' +
    '</svg>',
  nature:
    '<svg viewBox="0 0 320 160" preserveAspectRatio="xMidYMid slice" aria-hidden="true">' +
    '<rect width="320" height="160" fill="#e5eee8"/>' +
    '<path d="M0 100L70 40l50 44 60-56 70 62 70-40V160H0Z" fill="#3b7a4c"/>' +
    '<path d="M0 118L90 70l60 40 70-48 100 56V160H0Z" fill="#2f6b3f"/>' +
    '<rect y="124" width="320" height="36" fill="#1b6f8a"/>' +
    '<g fill="#1f4d2f"><path d="M36 124l12-30 12 30Z"/><path d="M58 124l10-24 10 24Z"/><path d="M262 124l12-30 12 30Z"/></g>' +
    '</svg>'
};

function cardHTML(d) {
  return (
    '<article class="card">' +
      '<div class="card-scene">' + mediaHTML(d) + '</div>' +
      '<div class="card-body">' +
        '<div class="card-meta"><span class="tag tag--' + d.category + '">' + CATEGORY_LABEL[d.category] + '</span></div>' +
        '<h3>' + d.name + '</h3>' +
        '<div class="card-meta">' + d.district + '</div>' +
        '<p>' + d.summary + '</p>' +
        '<button class="card-link" type="button" data-id="' + d.id + '">View details<span class="sr-only"> for ' + d.name + '</span></button>' +
      '</div>' +
    '</article>'
  );
}

// ---------- Mobile navigation ----------
const navToggle = document.querySelector(".nav-toggle");
const mainNav = document.querySelector(".main-nav");
if (navToggle && mainNav) {
  navToggle.addEventListener("click", function () {
    const open = mainNav.classList.toggle("open");
    navToggle.setAttribute("aria-expanded", String(open));
  });
}

// ---------- Home page: featured destinations ----------
const featured = document.getElementById("featured");
if (featured) {
  const ids = ["palabuhanratu", "cikaso", "ciletuh"];
  featured.innerHTML = DESTINATIONS
    .filter(function (d) { return ids.indexOf(d.id) !== -1; })
    .map(function (d) {
      return cardHTML(d).replace(/<button[\s\S]*?<\/button>/, '<a class="card-link" href="destination.php">See all destinations</a>');
    })
    .join("");
}

// ---------- Home page: guided trip ideas ----------
const tripPlanner = document.getElementById("trip-planner-form");
if (tripPlanner) {
  const tripPlans = {
    coast: {
      title: "An ocean-side escape",
      destinations: ["palabuhanratu", "karang-hawu", "ciletuh", "palangpang", "ujung-genteng"]
    },
    waterfall: {
      title: "Chasing waterfalls",
      destinations: ["cikaso", "sodong", "ciletuh", "situ-gunung"]
    },
    highlands: {
      title: "A little highland calm",
      destinations: ["situ-gunung", "ciletuh", "cikaso"]
    }
  };
  const durationLabels = {
    day: { count: 1, label: "One-day inspiration" },
    weekend: { count: 2, label: "A weekend to explore" },
    longer: { count: 3, label: "A longer Sukabumi escape" }
  };
  const result = document.getElementById("trip-planner-result");
  const resultTitle = document.getElementById("planner-result-title");
  const resultStops = document.getElementById("planner-stops");
  const reset = document.getElementById("planner-reset");

  tripPlanner.addEventListener("submit", function (event) {
    event.preventDefault();
    const data = new FormData(tripPlanner);
    const plan = tripPlans[data.get("interest")];
    const duration = durationLabels[data.get("duration")];
    if (!plan || !duration) return;

    resultTitle.textContent = plan.title + " · " + duration.label;
    resultStops.replaceChildren();
    plan.destinations.slice(0, duration.count).forEach(function (id, index) {
      const destination = DESTINATIONS.find(function (item) { return item.id === id; });
      if (!destination) return;
      const item = document.createElement("li");
      item.className = "planner-stop";
      const number = document.createElement("span");
      number.className = "planner-stop-number";
      number.textContent = String(index + 1).padStart(2, "0");
      const details = document.createElement("span");
      details.className = "planner-stop-details";
      const name = document.createElement("strong");
      name.textContent = destination.name;
      const district = document.createElement("small");
      district.textContent = destination.district;
      details.append(name, district);
      const link = document.createElement("a");
      link.href = "destination.php?search=" + encodeURIComponent(destination.name);
      link.className = "planner-stop-link";
      link.textContent = "View";
      link.setAttribute("aria-label", "View " + destination.name + " in the destination guide");
      item.append(number, details, link);
      resultStops.appendChild(item);
    });

    tripPlanner.hidden = true;
    result.hidden = false;
    result.scrollIntoView({ behavior: "smooth", block: "nearest" });
  });

  reset.addEventListener("click", function () {
    result.hidden = true;
    tripPlanner.hidden = false;
    tripPlanner.querySelector("button[type='submit']").focus();
  });
}

// ---------- Destination page ----------
const list = document.getElementById("destination-list");
if (list) {
  const searchInput = document.getElementById("search");
  const chips = document.querySelectorAll(".chip");
  const count = document.getElementById("result-count");
  const dialog = document.getElementById("detail-dialog");
  let category = "all";

  const initialSearch = new URLSearchParams(window.location.search).get("search");
  if (initialSearch) searchInput.value = initialSearch.slice(0, 80);

  const gallery = dialog.querySelector(".detail-gallery");
  let activeDestination = null;

  function showPhoto(d, photo, index) {
    const scene = dialog.querySelector(".dialog-scene");
    scene.innerHTML = mediaHTML({ image: photo.src, name: d.name + ": " + photo.title, category: d.category });
    const credit = dialog.querySelector(".dialog-credit");
    credit.replaceChildren();
    if (photo.author) {
      credit.appendChild(document.createTextNode("Photo by " + photo.author + " · " + photo.license + " · "));
      const source = document.createElement("a");
      source.href = photo.source;
      source.target = "_blank";
      source.rel = "noopener noreferrer";
      source.textContent = "Wikimedia Commons";
      credit.appendChild(source);
    }
    gallery.querySelectorAll(".detail-gallery-item").forEach(function (item) {
      item.setAttribute("aria-pressed", String(Number(item.dataset.photoIndex) === index));
    });
  }

  function showDetails(d) {
    activeDestination = d;
    dialog.querySelector(".dialog-tag").className = "tag tag--" + d.category + " dialog-tag";
    dialog.querySelector(".dialog-tag").textContent = CATEGORY_LABEL[d.category];
    dialog.querySelector("#detail-title").textContent = d.name;
    dialog.querySelector("#detail-gallery-title").textContent = "Photos of " + d.name;
    dialog.querySelector(".dialog-district").textContent = d.district;
    dialog.querySelector(".dialog-summary").textContent = d.summary;
    dialog.querySelector(".dialog-highlights").innerHTML = d.highlights.map(function (h) { return "<li>" + h + "</li>"; }).join("");
    dialog.querySelector(".dialog-bestfor").textContent = d.bestFor;
    dialog.querySelector(".dialog-tip").textContent = d.tip;
    gallery.replaceChildren();
    d.photos.forEach(function (photo, index) {
      const button = document.createElement("button");
      button.className = "detail-gallery-item";
      button.type = "button";
      button.dataset.photoIndex = String(index);
      button.setAttribute("aria-pressed", "false");
      button.setAttribute("aria-label", "Show photo: " + photo.title);
      const image = document.createElement("img");
      image.src = photo.src;
      image.alt = photo.title;
      image.loading = "lazy";
      image.addEventListener("error", function () { button.remove(); });
      const label = document.createElement("span");
      label.textContent = photo.title;
      button.append(image, label);
      gallery.appendChild(button);
    });
    showPhoto(d, d.photos[0], 0);
  }

  function render() {
    const query = searchInput.value.trim().toLowerCase();
    const matches = DESTINATIONS.filter(function (d) {
      const inCategory = category === "all" || d.category === category;
      const text = (d.name + " " + d.district + " " + d.summary).toLowerCase();
      return inCategory && (query === "" || text.indexOf(query) !== -1);
    });

    count.textContent = matches.length + (matches.length === 1 ? " destination" : " destinations");

    list.innerHTML = matches.length
      ? matches.map(cardHTML).join("")
      : '<p class="empty">No destinations match your search. Clear the search box or choose another category.</p>';
    observeReveals(list);
  }

  chips.forEach(function (chip) {
    chip.addEventListener("click", function () {
      category = chip.dataset.category;
      chips.forEach(function (c) { c.setAttribute("aria-pressed", String(c === chip)); });
      render();
    });
  });

  searchInput.addEventListener("input", render);

  list.addEventListener("click", function (event) {
    const button = event.target.closest(".card-link");
    if (!button) return;
    const d = DESTINATIONS.find(function (item) { return item.id === button.dataset.id; });
    if (!d) return;

    showDetails(d);
    dialog.showModal();
  });

  gallery.addEventListener("click", function (event) {
    const button = event.target.closest(".detail-gallery-item");
    if (!button || !activeDestination) return;
    const index = Number(button.dataset.photoIndex);
    const photo = activeDestination.photos[index];
    if (photo) showPhoto(activeDestination, photo, index);
  });

  dialog.querySelector(".dialog-close").addEventListener("click", function () { dialog.close(); });
  dialog.addEventListener("click", function (event) {
    if (event.target === dialog) dialog.close();
  });

  render();
}

// ---------- Kota Sukabumi city guide ----------
const cityList = document.getElementById("city-place-list");
if (cityList) {
  const searchInput = document.getElementById("city-search");
  const count = document.getElementById("city-result-count");
  const emptyState = document.getElementById("city-no-results");
  const chips = document.querySelectorAll(".chip[data-city-category]");
  let selectedCategory = "all";

  function filterCityPlaces() {
    const query = searchInput.value.trim().toLocaleLowerCase();
    let visibleCount = 0;
    cityList.querySelectorAll(".city-card").forEach(function (card) {
      const matchesCategory = selectedCategory === "all" || card.dataset.cityCategory === selectedCategory;
      const matchesSearch = !query || card.textContent.toLocaleLowerCase().indexOf(query) !== -1;
      const visible = matchesCategory && matchesSearch;
      card.hidden = !visible;
      if (visible) visibleCount += 1;
    });

    count.textContent = visibleCount + (visibleCount === 1 ? " place" : " places");
    emptyState.hidden = visibleCount !== 0;
  }

  chips.forEach(function (chip) {
    chip.addEventListener("click", function () {
      selectedCategory = chip.dataset.cityCategory;
      chips.forEach(function (option) {
        option.setAttribute("aria-pressed", String(option === chip));
      });
      filterCityPlaces();
    });
  });

  searchInput.addEventListener("input", filterCityPlaces);
  filterCityPlaces();
}

const cityPhotoDialog = document.getElementById("city-photo-dialog");
const cityPhotoData = document.getElementById("city-photo-data");
if (cityPhotoDialog && cityPhotoData) {
  const photos = JSON.parse(cityPhotoData.textContent);
  const fullImage = document.getElementById("city-photo-full");
  const caption = document.getElementById("city-photo-caption");
  const counter = document.getElementById("city-photo-counter");
  const thumbnails = document.getElementById("city-photo-thumbnails");
  let activePhoto = 0;
  let activePhotos = [];

  function showCityPhoto(index) {
    activePhoto = (index + activePhotos.length) % activePhotos.length;
    const photo = activePhotos[activePhoto];
    fullImage.src = photo.src;
    fullImage.alt = photo.alt;
    counter.textContent = "Photo " + (activePhoto + 1) + " of " + activePhotos.length;
    caption.replaceChildren(document.createTextNode(photo.caption));
    if (photo.userProvided) {
      caption.append(document.createTextNode(" " + photo.credit));
    } else {
      caption.append(document.createTextNode(" Photo: "));
      const creditLink = document.createElement("a");
      creditLink.href = photo.source;
      creditLink.target = "_blank";
      creditLink.rel = "noopener noreferrer";
      creditLink.textContent = photo.credit;
      caption.append(creditLink, document.createTextNode(" · "));

      const licenseLink = document.createElement("a");
      licenseLink.href = photo.licenseUrl;
      licenseLink.target = "_blank";
      licenseLink.rel = "noopener noreferrer";
      licenseLink.textContent = photo.license;
      caption.append(licenseLink);
    }

    thumbnails.querySelectorAll("button").forEach(function (button, photoIndex) {
      button.setAttribute("aria-pressed", String(photoIndex === activePhoto));
    });
  }

  document.querySelectorAll(".city-photo-open").forEach(function (button) {
    button.addEventListener("click", function () {
      const start = Number(button.dataset.cityPhotoIndex);
      const count = Number(button.dataset.cityPhotoCount);
      activePhotos = photos.slice(start, start + count);
      thumbnails.replaceChildren();
      activePhotos.forEach(function (photo, index) {
        const thumbnailButton = document.createElement("button");
        thumbnailButton.type = "button";
        thumbnailButton.className = "city-photo-thumb";
        thumbnailButton.setAttribute("aria-label", "Photo " + (index + 1) + ": " + photo.alt);
        thumbnailButton.setAttribute("aria-pressed", "false");
        const image = document.createElement("img");
        image.src = photo.src;
        image.alt = "";
        image.loading = "lazy";
        thumbnailButton.append(image);
        thumbnailButton.addEventListener("click", function () { showCityPhoto(index); });
        thumbnails.append(thumbnailButton);
      });
      showCityPhoto(0);
      cityPhotoDialog.showModal();
      document.getElementById("city-photo-close").focus();
    });
  });

  document.getElementById("city-photo-prev").addEventListener("click", function () {
    showCityPhoto(activePhoto - 1);
  });
  document.getElementById("city-photo-next").addEventListener("click", function () {
    showCityPhoto(activePhoto + 1);
  });
  document.getElementById("city-photo-close").addEventListener("click", function () {
    cityPhotoDialog.close();
  });
  cityPhotoDialog.addEventListener("click", function (event) {
    if (event.target === cityPhotoDialog) cityPhotoDialog.close();
  });
  cityPhotoDialog.addEventListener("keydown", function (event) {
    if (event.key === "Escape") cityPhotoDialog.close();
    if (event.key === "ArrowLeft") showCityPhoto(activePhoto - 1);
    if (event.key === "ArrowRight") showCityPhoto(activePhoto + 1);
  });
}

// ---------- Signup dialog ----------
const signupDialog = document.getElementById("signup-dialog");
const signupTrigger = document.querySelector(".signup-trigger");
if (signupDialog && signupTrigger) {
  const signupForm = document.getElementById("signup-form");
  const contactInput = document.getElementById("signup-contact");
  const contactLabel = document.getElementById("signup-contact-label");
  const signupStatus = document.getElementById("signup-status");
  const closeButton = signupDialog.querySelector(".signup-close");

  signupTrigger.addEventListener("click", function () {
    signupDialog.showModal();
    document.getElementById("signup-name").focus();
  });

  closeButton.addEventListener("click", function () { signupDialog.close(); });
  signupDialog.addEventListener("click", function (event) {
    if (event.target === signupDialog) signupDialog.close();
  });

  signupDialog.querySelectorAll("[data-signup-method]").forEach(function (button) {
    button.addEventListener("click", function () {
      const method = button.dataset.signupMethod;
      signupDialog.querySelectorAll("[data-signup-method]").forEach(function (option) {
        option.setAttribute("aria-pressed", String(option === button));
      });
      contactInput.value = "";
      contactInput.type = method === "phone" ? "tel" : "email";
      contactInput.autocomplete = method === "phone" ? "tel" : "email";
      contactInput.placeholder = method === "phone" ? "+62 812 3456 7890" : "you@example.com";
      contactLabel.textContent = method === "phone" ? "Phone number" : "Email address";
    });
  });

  signupForm.addEventListener("submit", function (event) {
    event.preventDefault();
    signupStatus.textContent = "This signup form isn't connected to a mailing list yet. Your details have not been sent or saved.";
  });
}

// ---------- Motion preferences ----------
if ("IntersectionObserver" in window && !window.matchMedia("(prefers-reduced-motion: reduce)").matches) {
  revealObserver = new IntersectionObserver(function (entries) {
    entries.forEach(function (entry) {
      if (!entry.isIntersecting) return;
      entry.target.classList.add("is-visible");
      revealObserver.unobserve(entry.target);
    });
  }, { threshold: 0.12, rootMargin: "0px 0px -24px 0px" });

  observeReveals(document);
  document.body.classList.add("motion-ready");
}

// ---------- Culinary gallery and filters ----------
const culinaryPhotos = {
  mochi: [
    { src: "images/mochi.jpg.jpeg", title: "Mochi Sukabumi" },
    {
      src: "https://upload.wikimedia.org/wikipedia/commons/d/d5/Mochi_Cianjur.jpg",
      title: "Mochi from Cianjur",
      author: "Reniniawati",
      license: "CC BY-SA 4.0",
      licenseUrl: "https://creativecommons.org/licenses/by-sa/4.0/",
      source: "https://commons.wikimedia.org/wiki/File:Mochi_Cianjur.jpg"
    },
    {
      src: "https://upload.wikimedia.org/wikipedia/commons/9/94/Mochi_Jombang.jpg",
      title: "Mochi sold in Jombang",
      author: "Indonesiagood",
      license: "CC BY 4.0",
      licenseUrl: "https://creativecommons.org/licenses/by/4.0/",
      source: "https://commons.wikimedia.org/wiki/File:Mochi_Jombang.jpg"
    }
  ],
  "grilled-fish": [
    { src: "images/grilled-fish.jpg", title: "Grilled fresh fish in Sukabumi" },
    {
      src: "https://upload.wikimedia.org/wikipedia/commons/e/ec/Gurame_bakar_kecap_2.JPG",
      title: "Gurame grilled with sweet soy sauce",
      author: "Gunawan Kartapranata",
      license: "CC BY-SA 4.0",
      licenseUrl: "https://creativecommons.org/licenses/by-sa/4.0/",
      source: "https://commons.wikimedia.org/wiki/File:Gurame_bakar_kecap_2.JPG"
    },
    {
      src: "https://upload.wikimedia.org/wikipedia/commons/1/13/Ikan_kakap_bakar_madu.JPG",
      title: "Grilled snapper",
      author: "Midori",
      license: "CC BY 3.0",
      licenseUrl: "https://creativecommons.org/licenses/by/3.0/",
      source: "https://commons.wikimedia.org/wiki/File:Ikan_kakap_bakar_madu.JPG"
    }
  ],
  "pepes-ikan": [
    { src: "images/pepes-ikan.jpg", title: "Pepes ikan" },
    {
      src: "https://upload.wikimedia.org/wikipedia/commons/1/1d/IkanPepes.JPG",
      title: "Ikan pepes, fish cooked in spice paste",
      author: "Midori",
      license: "CC BY-SA 3.0",
      licenseUrl: "https://creativecommons.org/licenses/by-sa/3.0/",
      source: "https://commons.wikimedia.org/wiki/File:IkanPepes.JPG"
    },
    {
      src: "https://upload.wikimedia.org/wikipedia/commons/2/2d/Pepes_ikan_emas_%28pais_lauk_mas%29_Sunda.jpg",
      title: "Sundanese pepes ikan mas",
      author: "Gunawan Kartapranata",
      license: "CC BY-SA 3.0",
      licenseUrl: "https://creativecommons.org/licenses/by-sa/3.0/",
      source: "https://commons.wikimedia.org/wiki/File:Pepes_ikan_emas_(pais_lauk_mas)_Sunda.jpg"
    }
  ],
  "nasi-liwet": [
    { src: "images/nasi-liwet.jpg", title: "Nasi liwet" },
    {
      src: "https://upload.wikimedia.org/wikipedia/commons/e/ed/Nasi_Liwet_A.JPG",
      title: "Nasi liwet served in Solo",
      author: "ESCapade",
      license: "CC BY-SA 3.0",
      licenseUrl: "https://creativecommons.org/licenses/by-sa/3.0/",
      source: "https://commons.wikimedia.org/wiki/File:Nasi_Liwet_A.JPG"
    },
    {
      src: "https://upload.wikimedia.org/wikipedia/commons/9/9a/Nasi_Liwet_Jolem.jpg",
      title: "Nasi liwet Jolem, Pangandaran",
      author: "Arief Rachman",
      license: "CC BY-SA 4.0",
      licenseUrl: "https://creativecommons.org/licenses/by-sa/4.0/",
      source: "https://commons.wikimedia.org/wiki/File:Nasi_Liwet_Jolem.jpg"
    }
  ],
  surabi: [
    { src: "images/surabi.jpg", title: "Surabi" },
    {
      src: "https://upload.wikimedia.org/wikipedia/commons/7/7e/Serabi-01.jpg",
      title: "Serabi with grated coconut",
      author: "Ivan Lanin",
      license: "CC BY-SA",
      licenseUrl: "https://creativecommons.org/licenses/by-sa/2.0/",
      source: "https://commons.wikimedia.org/wiki/File:Serabi-01.jpg"
    },
    {
      src: "https://upload.wikimedia.org/wikipedia/commons/3/38/Jajan_pasar_serabi_telur.jpg",
      title: "Serabi with egg",
      author: "Hersy ardianty a",
      license: "CC BY-SA 4.0",
      licenseUrl: "https://creativecommons.org/licenses/by-sa/4.0/",
      source: "https://commons.wikimedia.org/wiki/File:Jajan_pasar_serabi_telur.jpg"
    },
    {
      src: "https://upload.wikimedia.org/wikipedia/commons/7/71/Proses_pembuatan_serabi_kuno.jpg",
      title: "Traditional serabi being prepared",
      author: "Hersy ardianty a",
      license: "CC BY-SA 4.0",
      licenseUrl: "https://creativecommons.org/licenses/by-sa/4.0/",
      source: "https://commons.wikimedia.org/wiki/File:Proses_pembuatan_serabi_kuno.jpg"
    }
  ],
  lalapan: [
    { src: "images/lalapan.jpg", title: "Lalapan and sambal" },
    {
      src: "https://upload.wikimedia.org/wikipedia/commons/7/74/Lalab_platter_and_Sambal.jpg",
      title: "Lalab platter and sambal",
      author: "Gunawan Kartapranata",
      license: "CC BY-SA 3.0",
      licenseUrl: "https://creativecommons.org/licenses/by-sa/3.0/",
      source: "https://commons.wikimedia.org/wiki/File:Lalab_platter_and_Sambal.jpg"
    },
    {
      src: "https://upload.wikimedia.org/wikipedia/commons/b/be/Lalapan_Khas_Sunda.jpg",
      title: "Sundanese lalapan",
      author: "Aqilla Rahmi",
      license: "CC BY 4.0",
      licenseUrl: "https://creativecommons.org/licenses/by/4.0/",
      source: "https://commons.wikimedia.org/wiki/File:Lalapan_Khas_Sunda.jpg"
    }
  ]
};

const dishList = document.getElementById("dish-list");
if (dishList) {
  const dishCards = Array.from(dishList.querySelectorAll(".culinary-card"));
  const dishSearch = document.getElementById("dish-search");
  const searchClear = document.getElementById("dish-search-clear");
  const dishCount = document.getElementById("dish-result-count");
  const resetFilters = document.getElementById("dish-reset");
  const emptyState = document.getElementById("dish-empty-state");
  const emptyReset = document.getElementById("dish-empty-reset");
  const categoryButtons = document.querySelectorAll(".culinary-toolbar [data-dish-category]");
  const dialog = document.getElementById("dish-dialog");
  const dialogImage = dialog.querySelector(".dish-main-photo");
  const gallery = dialog.querySelector(".dish-gallery");
  const credit = dialog.querySelector(".dish-photo-credit");
  let activePhotos = [];

  function normalizeDishText(value) {
    return value
      .toLocaleLowerCase()
      .normalize("NFD")
      .replace(/[\u0300-\u036f]/g, "")
      .replace(/[^a-z0-9]+/g, " ")
      .trim();
  }

  function showDishPhoto(photo, index) {
    dialogImage.src = photo.src;
    dialogImage.alt = photo.title;
    dialogImage.onerror = function () {
      const fallback = activePhotos.find(function (item) { return item.src.indexOf("images/") === 0; });
      if (fallback && photo.src !== fallback.src) {
        showDishPhoto(fallback, activePhotos.indexOf(fallback));
        return;
      }
      dialogImage.alt = "Photo unavailable";
      credit.textContent = "This photo could not be loaded.";
    };
    credit.replaceChildren();
    if (photo.author && photo.license && photo.source) {
      credit.appendChild(document.createTextNode("Photo: " + photo.author + " · "));
      const licenseLink = document.createElement("a");
      licenseLink.href = photo.licenseUrl;
      licenseLink.target = "_blank";
      licenseLink.rel = "noopener noreferrer";
      licenseLink.textContent = photo.license;
      credit.append(licenseLink, document.createTextNode(" · "));
      const sourceLink = document.createElement("a");
      sourceLink.href = photo.source;
      sourceLink.target = "_blank";
      sourceLink.rel = "noopener noreferrer";
      sourceLink.textContent = "Wikimedia Commons";
      credit.appendChild(sourceLink);
    }
    gallery.querySelectorAll(".detail-gallery-item").forEach(function (item) {
      item.setAttribute("aria-pressed", String(Number(item.dataset.photoIndex) === index));
    });
  }

  function openDish(card) {
    const id = card.querySelector("[data-dish-id]").dataset.dishId;
    const photos = culinaryPhotos[id];
    if (!photos || photos.length === 0) return;
    activePhotos = photos;
    dialog.querySelector("#dish-dialog-title").textContent = card.querySelector("h3").textContent;
    dialog.querySelector(".dish-dialog-tag").textContent = card.querySelector(".tag").textContent;
    dialog.querySelector(".dish-dialog-tag").className = "tag dish-dialog-tag tag--" + card.dataset.dishCategory;
    dialog.querySelector(".dish-dialog-description").textContent = card.querySelector(".card-body > p").textContent;
    dialog.querySelector(".dish-dialog-goodfor").textContent = card.querySelector(".card-meta:last-of-type").textContent;
    gallery.replaceChildren();
    photos.forEach(function (photo, index) {
      const button = document.createElement("button");
      button.className = "detail-gallery-item";
      button.type = "button";
      button.dataset.photoIndex = String(index);
      button.setAttribute("aria-pressed", String(index === 0));
      button.setAttribute("aria-label", "Show photo: " + photo.title);
      const image = document.createElement("img");
      image.src = photo.src;
      image.alt = "";
      image.loading = "lazy";
      image.addEventListener("error", function () { button.remove(); });
      const label = document.createElement("span");
      label.textContent = photo.title;
      button.append(image, label);
      gallery.appendChild(button);
    });
    showDishPhoto(photos[0], 0);
    dialog.showModal();
  }

  function filterDishes() {
    const query = normalizeDishText(dishSearch.value);
    const queryTerms = query ? query.split(/\s+/) : [];
    const selectedCategory = document.querySelector(".culinary-toolbar [data-dish-category][aria-pressed='true']").dataset.dishCategory;
    let visibleCount = 0;
    dishCards.forEach(function (card) {
      const searchableWords = normalizeDishText(card.dataset.dishSearch).split(/\s+/);
      const matches = (selectedCategory === "all" || card.dataset.dishCategory === selectedCategory)
        && queryTerms.every(function (term) {
          return searchableWords.some(function (word) {
            return word === term
              || (term.length > 3 && word.indexOf(term) === 0)
              || (word.length > 3 && term.indexOf(word) === 0);
          });
        });
      card.hidden = !matches;
      if (matches) visibleCount += 1;
    });

    const filtering = queryTerms.length > 0 || selectedCategory !== "all";
    dishCount.textContent = visibleCount === 0
      ? "No dishes found"
      : visibleCount + (visibleCount === 1 ? " dish" : " dishes") + (filtering ? " found" : " to explore");
    searchClear.hidden = dishSearch.value.length === 0;
    resetFilters.hidden = !filtering;
    emptyState.hidden = visibleCount !== 0;
  }

  function resetDishFilters() {
    dishSearch.value = "";
    categoryButtons.forEach(function (button) {
      button.setAttribute("aria-pressed", String(button.dataset.dishCategory === "all"));
    });
    filterDishes();
  }

  categoryButtons.forEach(function (button) {
    button.addEventListener("click", function () {
      categoryButtons.forEach(function (item) { item.setAttribute("aria-pressed", String(item === button)); });
      filterDishes();
    });
  });
  dishSearch.addEventListener("input", filterDishes);
  searchClear.addEventListener("click", function () {
    dishSearch.value = "";
    filterDishes();
    dishSearch.focus();
  });
  resetFilters.addEventListener("click", resetDishFilters);
  emptyReset.addEventListener("click", function () {
    resetDishFilters();
    dishSearch.focus();
  });
  dishList.addEventListener("click", function (event) {
    const button = event.target.closest("[data-dish-id]");
    if (!button) return;
    openDish(button.closest(".culinary-card"));
  });
  gallery.addEventListener("click", function (event) {
    const button = event.target.closest(".detail-gallery-item");
    if (!button) return;
    const index = Number(button.dataset.photoIndex);
    if (activePhotos[index]) showDishPhoto(activePhotos[index], index);
  });
  dialog.querySelector(".dialog-close").addEventListener("click", function () { dialog.close(); });
  dialog.addEventListener("click", function (event) {
    if (event.target === dialog) dialog.close();
  });
  filterDishes();
}