var prefiksPage = "pages/",
    prefiksDok = "assets/doc/",
    prefiksSlike = "assets/images/",
    prefiksPomocno = "",
    prefiksOnline = "/BakinoCudoDoo/";
const bodyTag = document.getElementsByTagName("body"),
    strelicaObj = document.querySelector("#strelicaPocetak"),
    navigacijaLink = document.querySelector("#navigacija"),
    nizProizvoda = ["Predjela", "Kuvanih jela", "Salata", "Peciva", "Slatkiša", "Alkohola"];
var nizCboxa = [];
const footerLink = document.querySelector("footer .row.py-3 > div"),
    footerInfo = document.querySelector("footer ul#contact"),
    footerInfoFaIcons = ["phone", "envelope", "map-marker-alt"],
    footerInfoTxt = ["&nbsp;&nbsp;063/710-5150", "&nbsp;&nbsp;aleksandar&#46;zivic&#46;7&#46;21&#64;ict&#46;edu&#46;rs", `&nbsp;&nbsp;Zdravka Čelara 16, Belgrade`],
    footerIcons = document.querySelector("footer ul.d-flex");
let url = window.location.pathname;

function proveraFormeUzivo(e) {
    let i = document.querySelector("select");
    var a = document.querySelectorAll(".form-floating.col-md-12 > .row");
    i.addEventListener("change", function() {
        let e = Number(i.value);
        e ? (i.previousElementSibling.classList.remove("text-danger"), i.previousElementSibling.classList.add("text-success"), i.classList.remove("az-form-border"), prikazCheckBoxova(e), a[0].previousElementSibling.classList.remove("az-invisible"), a[0].classList.remove("az-invisible"), a[1].classList.remove("az-invisible"), a.forEach(e => {
            e.querySelectorAll("input[type='checkbox']").forEach(e => nizCboxa.push(e))
        })) : (i.previousElementSibling.classList.add("text-danger"), i.previousElementSibling.classList.remove("text-success"), i.classList.add("az-form-border"), a[0].previousElementSibling.classList.add("az-invisible"), a[0].classList.add("az-invisible"), a[1].classList.add("az-invisible"), a[1].nextElementSibling.classList.add("az-invisible"))
    }), e.forEach(function(e) {
        e.addEventListener("keyup", function() {
            e.value.length ? (e.classList.remove("az-form-border"), e.nextElementSibling.nextElementSibling.classList.add("az-invisible"), proveriElem(e)) : (bool = !1, e.classList.add("az-form-border"), e.nextElementSibling.nextElementSibling.innerHTML = "Niste popunili polje", e.nextElementSibling.nextElementSibling.classList.remove("az-invisible"))
        })
    })
}

function zavrsiLoadScreen() {
    $("#load-screen").addClass("az-anim-opac"), $(bodyTag).addClass("az-body-visi"), setTimeout(function() {
        $("#load-screen").addClass("az-load-del")
    }, 1150)
}

function prikazNavigacije(e, i) {
    let a = "";
    for (indeks in e) a += "<li class='nav-item me-1'>", a += `<a class='nav-link fs-5 px-3 py-2 az-red' href=${i[indeks]}>${e[indeks]}</a>`, a += "</li>";
    navigacijaLink.innerHTML = a
}

function glavniLink(e) {
    navigacijaLink.querySelectorAll("li > a").forEach(function(i) {
        i.getAttribute("href") == e && (i.classList.remove("az-red"), i.classList.add("active"))
    })
}

function slajderSlike(e, i, a) {
    for (let t = 0; t < i.length; t++) {
        var s = document.createElement("div");
        s.classList.add("carousel-item"), t || s.classList.add("az-visible"), s.innerHTML = `<img src='${a[t]}' class="d-block w-100 mx-auto" alt="${i[t]}"/>`, e.lastElementChild.appendChild(s)
    }
}

function strelicaPrikaz() {
    document.addEventListener("scroll", function() {
        window.scrollY > 900 ? strelicaObj.classList.contains("postaviStrelicu") || (strelicaObj.classList.remove("skiniStrelicu"), strelicaObj.classList.add("postaviStrelicu"), strelicaObj.classList.add("d-flex")) : strelicaObj.classList.contains("postaviStrelicu") && (strelicaObj.classList.remove("postaviStrelicu"), strelicaObj.classList.add("skiniStrelicu"), setTimeout(() => {
            strelicaObj.classList.remove("d-flex")
        }, 300))
    }), strelicaPocetak.addEventListener("click", function() {
        window.scrollTo(0, 0)
    })
}

function prikazPrednosti(e, i) {
    for (element of i) {
        let a = `<div class="col-lg-3 col-md-6 col-10 offset-sm-1 offset-1 offset-md-0 mb-5">
                        <div class="card position-relative">`;
        a += `<img src=${element.slikaSrc} class="card-img-top" alt="${element.slikaAlt}"/>`, a += `<div class="az-icon d-flex justify-content-center align-items-center bg-warning rounded-circle position-absolute">
                    <i class="fa-solid fa-${element.faIcon} fs-2 "></i>
                </div>`, a += `<div class="card-body">
                    <h5 class="card-title fw-bold">${element.naslov}</h5>
                    <p class="card-text">${element.tekst}</p>
                </div>
            </div>
        </div>`, e.innerHTML += a
    }
}

function procitajVise(e) {
    e.each((e, i) => $(i).click(function() {
        $(this).prev().slideToggle(600), "Pročitaj više" == $(this).html() ? $(this).html("Pročitaj manje") : $(this).html("Pročitaj više")
    }))
}

function ispisSvihNaslova(e, i) {
    for (element in e)
        if ("" != e[element].oznaka && (i[element].innerHTML += `<h2 class="fs-6">${e[element].oznaka}</h2>`), e[element].naslov, i[element].innerHTML += `<h3 class="pb-2 fs-1 text-capitalize">${e[element].naslov}</h3>`, "" != e[element].opis) {
            var a = document.createElement("p");
            a.classList.add("py-2", "az-pad");
            var t = document.createTextNode(e[element].opis);
            a.appendChild(t), i[element].appendChild(a)
        }
}

function ispisSaveta(e, i) {
    i.forEach(function(a, t) {
        a.innerHTML += `<div class="card-body position-relative">
         <div class="az-icon d-flex justify-content-center align-items-center align-content-center bg-warning rounded-circle position-absolute">
           <p class="fw-bold text-center text-uppercase">${e[t].dan}<br/>${e[t].mesec}</p>
        </div>
         <h4 class="fs-6">${e[t].kategorija}</h4>
         <h5 class="card-title fw-bold">${e[t].naslov}</h5>
         <p class="card-text">${e[t].opis}</p>
         <a href="pages/saveti.html" class="btn btn-primary az-bg-red-2">Saznaj više</a>  </div>`;
        let s = i[t].querySelector(".card-body").previousElementSibling;
        s.setAttribute("src", prefiksSlike + e[t].link), s.setAttribute("alt", `${e[t].alt}`)
    })
}

function ispisKomentara(e, i) {
    i.forEach((i, a) => {
        var t = "";
        t += `<div class="col-md-3">
        <img src="${prefiksSlike+e[a].link}" class="img-fluid rounded-start" alt="${e[a].alt}"/></div>`, t += `<div class="col-md-9 d-flex align-items-center">
        <div class="card-body">
          <h5 class="card-title">${e[a].ime}</h5>
          <h6>${e[a].posao}</h6>`;
        let s = "";
        s += '<div class="row w-50 mx-auto">', s += `<div class="col-2 offset-1">
                <img class="w-100 mx-auto" src="assets/images/Logo.png" alt="Baka logo"/>
                </div>`;
        for (let l = 2; l < 6; l++) l <= e[a].ocena ? s += `<div class="col-2 ">
                <img class="w-100 mx-auto" src="assets/images/Logo.png" alt="Baka logo"/>
                </div>` : s += `<div class="col-2">
                <img class="w-100 mx-auto az-opac" src="assets/images/Logo.png" alt="Baka logo"/>
                </div>`;
        s += "</div>", t += s, t += `<p class="card-text py-3">${e[a].opis}</p>
        <p class="card-text"><small class="text-muted">Poslato: ${e[a].datum}</small></p></div></div>`, i.innerHTML = t
    })
}

function prikazFooterLinkova(e, i) {
    for (let a = 0; a < 3; a++) footerLink.innerHTML += `<ul class="row my-3">
        <li class="col-6"><a href="${i[a]}">${e[a]}</a></li>
        <li class="col-6"><a href="${i[a+3]}">${e[a+3]}</a></li>
      </ul>`
}

function prikazFooterInformacija() {
    for (element in footerInfoFaIcons) footerInfo.innerHTML += `<li class="my-3"><i class="fas fa-${footerInfoFaIcons[element]}"></i>${footerInfoTxt[element]}</li>`
}

function prikazFooterIkonica(e) {
    for (element of e) footerIcons.innerHTML += `<li><a class="az-sm d-flex justify-content-center align-items-center rounded-circle" href="${element.link}"><i class="${element.icon}"></i></a> </li>`
}

function prikazForme(e, i) {
    for (let a = 0; a < e.length; a++) e[a].addEventListener("focus", function() {
        i[a].innerHTML += `  (Primer: ${e[a].getAttribute("placeholder")})`
    }), e[a].addEventListener("blur", function() {
        i[a].innerHTML = i[a].getAttribute("for").substring(5) + '<span class="text-danger"><i class="fa-regular fa-asterisk"></i></span>'
    })
}

function proveraForme() {
    var e = !0;
    let i = this.parentElement.parentElement.querySelectorAll("input[type='text'],input[type='email']"),
        a = document.querySelector("select"),
        t = document.kontaktForm.tipKontakt;
    i.forEach((i, a) => {
        i.value.length ? proveriElem(i) || (e = !1) : (e = !1, i.classList.add("az-form-border"), i.nextElementSibling.nextElementSibling.innerHTML = "Niste popunili polje", i.nextElementSibling.nextElementSibling.classList.remove("az-invisible"))
    });
    let s = 0;
    if (a.selectedIndex ? (a.classList.remove("az-form-border"), nizCboxa.forEach(function(e) {
            e.checked && s++
        }), s ? document.querySelector(".form-floating.col-md-12 > .row").nextElementSibling.nextElementSibling.classList.add("az-invisible") : (document.querySelector(".form-floating.col-md-12 > .row").nextElementSibling.nextElementSibling.classList.remove("az-invisible"), e = !1)) : (e = !1, a.classList.add("az-form-border")), t.value ? t[0].parentElement.parentElement.nextElementSibling.classList.add("az-invisible") : (t[0].parentElement.parentElement.nextElementSibling.classList.remove("az-invisible"), e = !1), e) {
        this.previousElementSibling.classList.remove("az-red"), this.previousElementSibling.classList.add("text-success"), this.previousElementSibling.innerHTML = "Uspešno ste naručili hranu !", i.forEach((e, i) => {
            e.value = ""
        }), a.selectedIndex = 0, a.previousElementSibling.classList.add("text-danger"), a.previousElementSibling.classList.remove("text-success"), a.classList.remove("az-form-border");
        let l = document.querySelectorAll(".form-floating.col-md-12 > .row");
        l[0].previousElementSibling.classList.add("az-invisible"), l[0].classList.add("az-invisible"), l[1].classList.add("az-invisible"), l[1].nextElementSibling.classList.add("az-invisible")
    } else this.previousElementSibling.classList.add("az-red"), this.previousElementSibling.classList.remove("text-success"), this.previousElementSibling.innerHTML = "Niste dobro popunili formu !";
    this.previousElementSibling.classList.remove("az-invisible")
}

function proveriElem(e) {
    let i = !0,
        a = !0;
    return e.id.match(/input(?=(Ime|Prezime))/) && (i = /^([A-ZČĆŽŠĐ][a-zčćžšđ]{2,})(\s[A-ZČĆŽŠĐ][a-zčćžšđ]{2,})*$/.test(e.value)), "inputEmail" == e.id && (i = /^[\w\_]{3,}\@[a-z]{3,}\.[a-z]{2,3}$/.test(e.value)), "inputTelefon" == e.id && (i = /^(06[^7]\/[0-9]{7})|(067\/7[0-9]{6})$/.test(e.value)), i ? (e.classList.remove("az-form-border"), e.parentElement.lastElementChild.classList.add("az-invisible")) : (a = !1, e.classList.add("az-form-border"), e.parentElement.lastElementChild.classList.remove("az-invisible"), e.parentElement.lastElementChild.innerHTML = "Niste popunili polje u trazenom formatu"), a
}

function prikazCheckBoxova(e) {
    let i = document.querySelector(".form-floating.col-md-12 > .row");
    i.innerHTML = "";
    let a;
    a = 3 === e ? 5 : 6;
    for (let t = 0; t < a; t++) {
        let s = document.createElement("div");
        s.classList.add("col-4", "text-center");
        let l = document.createElement("input"),
            n = nizProizvoda[t].substring(0, 5).toLowerCase();
        l.setAttribute("id", n), l.setAttribute("type", "checkbox"), l.setAttribute("value", `${t}`), l.classList.add("form-check-input", "me-2");
        let o = document.createElement("label");
        o.setAttribute("for", n), o.classList.add("form-check-label"), o.innerText = nizProizvoda[t], s.appendChild(l), s.appendChild(o), i.appendChild(s), 2 == t && ((i = i.nextElementSibling).innerHTML = "")
    }
}

function padajuciMeni() {
    $("#btnMeni").click(function() {
        $(this).next().slideToggle()
    })
}
url = "/BakinoCudoDoo/" == url ? "/BakinoCudoDoo/index.html" : url, window.onload = function() {
    if ("/BakinoCudoDoo/index.html" == url) {
        let e = document.querySelector("#carouselSliderIndicators"),
            i = [`${prefiksOnline+prefiksSlike}slanaJela.jpg`, `${prefiksOnline+prefiksSlike}cokolodnaTorta.jpg`, `${prefiksOnline+prefiksSlike}rakijaViseFlasa.jpg`],
            a = document.querySelector("#blokPrednosti");
        var t = [];
        t.push({
            slikaSrc: `${prefiksOnline+prefiksSlike}svezeNamirnice.jpg`,
            slikaAlt: "Sveze namirnice",
            naslov: "Sveže namirnice",
            tekst: "Namirnice koje koristimo su isključivo od naših sigurnih partnera.",
            faIcon: "carrot"
        }), t.push({
            slikaSrc: `${prefiksOnline+prefiksSlike}brzaDostava.jpg`,
            slikaAlt: "Brza Dostava",
            naslov: "Brza dostava",
            tekst: "Naši dostavljači su brzi i vešti da dostave hranu gde god je potrebno.",
            faIcon: "clock"
        }), t.push({
            slikaSrc: `${prefiksOnline+prefiksSlike}raznovrsnaHrana.jpg`,
            slikaAlt: "Raznovrsna hrana",
            naslov: "Raznovrsna jela",
            tekst: "Imamo raznovrsan jelovnik, kako bi svako pronašao obrok za sebe.",
            faIcon: "bowl-food"
        }), t.push({
            slikaSrc: `${prefiksOnline+prefiksSlike}velikoIskustvo.jpg`,
            slikaAlt: "Veliko iskustvo",
            naslov: "Veliko iskustvo",
            tekst: "Naša ekipa radi kompaktno i gotovo bez greške dugi niz godina.",
            faIcon: "star"
        });
        let s = document.querySelectorAll("#Komentari div.col-12.text-center"),
            l = $("button[data-az-slide]");
        slajderDugmici(l);
        let n = $("#Usluge .card-body button"),
            o = document.querySelectorAll("#Usluge .row.mt-3 > div.col-12.text-center"),
            r = [];
        r.push({
            naslov: "Naše Usluge",
            oznaka: `Ketering "Bakino čudo"`,
            opis: ""
        }), r.push({
            naslov: "Naruči specijalitete",
            oznaka: `Ketering "Bakino čudo"`,
            opis: ""
        }), r.push({
            naslov: "Bakini Saveti",
            oznaka: `Ketering "Bakino čudo"`,
            opis: "Baka Zorka svoje savete za održavanje kuhinje i ideje za razna jela voli da deli pa tako imate šta da naučite ako želite sami da napravite neko jelo."
        });
        let c = [];
        c.push({
            naslov: "Kako očistiti mašinu za sudove?",
            kategorija: "Higijena kuhinje",
            dan: 11,
            mesec: "apr",
            opis: "Zvuči jednostavno, ali ljudi ne znaju kako da se reše neprijatnog mirisa nakon pranja sudova.",
            link: "savetiMasina.jpg",
            alt: "mašina za sudove"
        }), c.push({
            naslov: "Kako da umesite lepo testo?",
            kategorija: "Kuvanje",
            dan: 17,
            mesec: "feb",
            opis: `Postoje razna testa koje možete umesiti, ali ovde ćemo proći ono što me najviše ljudi pitalo. `,
            link: "savetiTesto.jpg",
            alt: "mešanje testa"
        }), c.push({
            naslov: "5 saveta profesionalnog kuvara",
            kategorija: "Praktični saveti",
            dan: 9,
            mesec: "jan",
            opis: `Profesionalni kuvari vole da podele razne detalje sa svoga posla, ali neke ključne prećute.`,
            link: "savetiKuvar.jpg",
            alt: "profesionalni kuvar"
        });
        let d = document.querySelectorAll("#Usluge div.row.mt-3 div.card"),
            u = document.querySelectorAll("#Komentari .row.g-0"),
            p = [];
        p.push({
            ime: "Milorad Petrović",
            posao: "It stručnjak",
            datum: "20.2.2022.",
            opis: `Pravio sam žurku i naručio sam hranu par sati pre žurke. Nisam očekivao, ali ona je stigla na vreme vruća i ukusna. Svi su bili zadovoljni i pitali su me odakle sam naručio tako kvalitetnu hranu.`,
            link: "komentariIT.jpg",
            alt: "čovek It stručnjak",
            ocena: 5
        }), p.push({
            ime: "Marija Spasić",
            posao: "Menadžer",
            datum: "22.1.2022.",
            opis: `Čula sam od drugarice za njih i naručila sam hranu za moju svadbu. Kvalitet hrane je bio odličan i svi su bili oduševljeni i sve je bilo gotovo u roku kako smo se dogovorili. Jedino su malo skuplji, ali vredi.`,
            link: "komentariMenadzer.jpg",
            alt: "žena menadžer",
            ocena: 4
        }), p.push({
            ime: "Srđan Janketić",
            posao: "Vlasnik vrtića",
            datum: "13.3.2022.",
            opis: `Dugo godina je moja ekipa tragala za dobrim keteringom koji nudi raznovrsnu hranu za sve mališane. Jedino je <span class="fw-bold">Keternig "Bakino Čudo"</span> uspeo da nas zadovolji kvalitetom i brzinom njihovih vozača.`,
            link: "komentariVlasnik.jpg",
            alt: "čovek vlasnik vrtića",
            ocena: 5
        });
        let v = document.querySelector("#kontaktForm");
        var m = v.querySelectorAll("input[type='text'],input[type='email']"),
            k = v.querySelectorAll("label"),
            f = v.querySelector("#dugmeProvera");
        proveraFormeUzivo(m), f.addEventListener("click", proveraForme), slajderSlike(e, ["slano posluzenje", "čokolodna torta", "flaše rakije raznih ukusa"], i), prikazPrednosti(a, t), procitajVise(n), ispisSvihNaslova(r, o), ispisSvihNaslova([{
            naslov: "Komentari posetilaca",
            oznaka: "",
            opis: "Stalno dobijamo komentare i ovde možete videti šta ljudi koji su probali naše specijalitete misle o njima."
        }], s), ispisSaveta(c, d), ispisKomentara(p, u), prikazForme(m, k)
    } else prefiksPomocno = "../", prikazImenaStrane();
    if (url == `${prefiksOnline}pages/usluge.html` && funkModal(), url == `${prefiksOnline}pages/meni.html`) {
        let b = document.querySelector(".row.text-center > button");
        b.addEventListener("click", function() {
            b.parentElement.previousElementSibling.classList.toggle("az-invisible"), "Vidi više" == b.innerText ? b.innerText = "Vidi manje" : b.innerText = "Vidi više"
        })
    }
    url == `${prefiksOnline}pages/kontakt.html` && formaPlugin();
    var g = [];
    g.push({
        link: "https://twitter.com/",
        icon: "fab fa-twitter"
    }), g.push({
        link: "https://www.instagram.com/",
        icon: "fab fa-instagram"
    }), g.push({
        link: "https://www.facebook.com/",
        icon: "fab fa-facebook-f"
    }), g.push({
        link: `${prefiksOnline+prefiksDok}Dokumentacija.pdf`,
        icon: "fa-solid fa-file"
    }), g.push({
        link: `${prefiksOnline}sitemap.xml`,
        icon: "fa-solid fa-sitemap"
    }), g.push({
        link: `${prefiksOnline}rss.xml`,
        icon: "fas fa-rss"
    });
    let h = ["Početna", "Usluge", "Meni", "Saveti", "Kontakt", "O autoru"],
        z = [`${prefiksOnline}index.html`, `${prefiksOnline+prefiksPage}usluge.html`, `${prefiksOnline+prefiksPage}meni.html`, `${prefiksOnline+prefiksPage}saveti.html`, `${prefiksOnline+prefiksPage}kontakt.html`, `${prefiksOnline+prefiksPage}autor.html`];
    padajuciMeni(), strelicaPrikaz(), prikazNavigacije(h, z), glavniLink(url), prikazFooterLinkova(h, z), prikazFooterInformacija(), prikazFooterIkonica(g), setTimeout(zavrsiLoadScreen, 1300), setTimeout(() => $("#load-screen").remove(), 2300), setTimeout(slajderAnimacija, 4500)
};
let brAk = 0;

function slajderDugmici(e) {
    e.each(function(i, a) {
        let t = i;
        $(a).click(function() {
            var i = $("#carouselSliderIndicators .carousel-inner .az-visible"),
                a = $(i.parent().children()[t]);
            a.hasClass("az-visible") || (i.hide("slow").removeClass("az-visible"), a.fadeIn().addClass("az-visible")), brAk = t, $(e).removeClass("az-active"), $(this).addClass("az-active")
        })
    })
}

function slajderAnimacija() {
    var e = $("#carouselSliderIndicators .carousel-inner .az-visible"),
        i = e.next().length ? e.next() : e.parent().children(":first");
    e.hide("slow").removeClass("az-visible"), i.fadeIn().addClass("az-visible");
    let a = $("#carouselSliderIndicators button").filter(`button[data-az-slide = ${brAk}]`),
        t = a.next().length ? a.next() : a.parent().children(":first");
    brAk = brAk < 2 ? ++brAk : 0, a.removeClass("az-active"), t.addClass("az-active"), setTimeout(slajderAnimacija, 4e3)
}

function funkModal() {
    document.querySelectorAll(".card-body > button").forEach(e => {
        e.addEventListener("click", function() {
            $(this).next().addClass("az-visible"), $(this).next().animate({
                opacity: "1"
            }, 500), $('<div id="pozadinaModal" class="modal-backdrop fade show"></div>').appendTo($("body"))
        })
    });
    document.querySelectorAll(".modal-header > button,.modal-footer > button").forEach(e => {
        e.addEventListener("click", function() {
            let e = $(this).parent().parent().parent().parent();
            e.animate({
                opacity: "0"
            }, 500), setTimeout(function() {
                $(e).removeClass("az-visible")
            }, 500), $("#pozadinaModal").remove()
        })
    })
}

function formaPlugin() {
    jQuery.validator.setDefaults({
        debug: !0,
        success: "valid"
    });
    let e = document.querySelectorAll("input");
    prikazForme(e, document.querySelectorAll("label"));
    let i = $("#konForm");
    var a = i.validate({
        rules: {
            inputIme: {
                required: !0,
                minlength: 3
            },
            inputPrezime: {
                required: !0,
                minlength: 3
            },
            inputEmail: {
                required: !0,
                email: !0
            },
            txtOblast: {
                required: !0
            }
        },
        success: function(e) {
            e.text("").addClass("valid")
        }
    });
    let t;
    $(".col-12 > button").click(function() {
        (t = i.valid()) && (!proveriElem(e[0]) || !proveriElem(e[1])) && (t = !1);
        let s = $("#porukaGreska"),
            l = document.querySelector("textarea");
        brisiPoruke(a), l.value.length && (l.nextElementSibling.innerHTML = ""), t ? (s.removeClass("az-invisible"), s.html("Sve je ispravno popunjeno poruka je poslata!"), s.removeClass("az-red"), s.addClass("text-success"), $("label.error").text(""), e.forEach(e => {
            e.value = ""
        }), l.value = "") : (s.removeClass("az-invisible"), s.html("Niste popunili sva polja ispravno !"), s.removeClass("text-success"), s.addClass("az-red"))
    }), e.forEach(e => {
        e.addEventListener("focus", function() {
            brisiPoruke(a)
        })
    })
}

function brisiPoruke(e) {
    e.showErrors({
        inputIme: "",
        inputEmail: "",
        inputPrezime: "",
        txtOblast: "Morate ostaviti poruku koju prosleđujete!"
    })
}

function prikazImenaStrane() {
    document.querySelectorAll("#naslovna span").forEach(function(e) {
        e.innerText = url.substring(url.lastIndexOf("/") + 1, url.lastIndexOf(".")).toLowerCase()
    })
}