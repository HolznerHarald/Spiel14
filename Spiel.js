// JavaScript source code
container1.hidden = true;
document.getElementById("Wirf").disabled = true;
glNameNr = 0;
glGegner = 0;
glErsterSpieler = 0;
glBinGeradeDran = 0;
glLadenFertig = 0;
glAuswahlSelectedIndex = 0;
glRundenZae = 0;
glGegnerWurf = 0;
glMeinWurf = 0;
//laden("pAppend.php", "Test", "test.txt", glNameNr + ":88",glNameNr + ":8Ende");
function fSAuswahl() {
    let hh = document.getElementById("Auswahl").options[glAuswahlSelectedIndex].label;

    if (hh[1] == glNameNr) {
        alert("nicht selbst auswaehlen");
        return;
    } else {
        laden("pZustimmen.php", "Liste", hh[1], glNameNr);
        glErsterSpieler = hh[1];
        container1.hidden = false;
    }
}

function fonchange() {
    glAuswahlSelectedIndex = document.getElementById("Auswahl").selectedIndex;
}

function fNeues() {
    laden("pNeues.php", "Liste", glNameNr);
}
function fWirf() {
    let zz = Math.floor(Math.random() * 6) + 1;
    glMeinWurf = zz;
    document.getElementById("Resultat").innerHTML = zz;
    document.getElementById("Wirf").disabled = true;
    glBinGeradeDran = 0;
    if (glNameNr != glErsterSpieler) {
        if (glGegnerWurf > glMeinWurf)
            document.getElementById("GegnerScore").innerHTML++;
        else if (glGegnerWurf < glMeinWurf)
            document.getElementById("MeinScore").innerHTML++;
    }
    laden("pAppend.php", "Test", "a" + glErsterSpieler + ".txt", glNameNr + ":" + zz, glNameNr + ":Ende");
}

function fListe() {
    if (glLadenFertig == 0) {
        return;
    }
    glLadenFertig = 0;

    if (glErsterSpieler == 0) {
        laden("pFileLaden.php", "Liste", "user1");
    } else {
        laden("pFileLaden.php", "Ablauf", "a" + glErsterSpieler);
    }
}

function laden(url, element, eingabe = "", eingabe2 = "", eingabe3 = "") {
    if (glBinGeradeDran == 1)
        return;

    let ajaxObj = new XMLHttpRequest();
    ajaxObj.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById(element).innerHTML = this.responseText;

            hzei = "";
            hzei = this.responseText;

            if (glNameNr == 0) {
                glNameNr = this.responseText.substring(0, 1);
            }
            if (element == "Liste") {
                zeilen = this.responseText.replace(/\r\n/g, "\n").split("\n");
                for (let i = 0; i < zeilen.length; i++) {
                    if (zeilen[i][0] == "g" && zeilen[i][1] == glNameNr) {
                        document.getElementById("Test").innerHTML += "T222";
                        glErsterSpieler = glNameNr;
                        document.getElementById("Wirf").disabled = false;
                        glBinGeradeDran = 1;
                        container1.hidden = false;
                    }

                    if (zeilen[i] != "") {
                        NeuerEintrag = new Option(zeilen[i], zeilen[i], false, true);
                        document.getElementById("Auswahl").options[i] = NeuerEintrag;
                    }
                }
                document.getElementById("Auswahl").selectedIndex = glAuswahlSelectedIndex;
            } else if (element == "Ablauf") {
                zeilen = this.responseText.replace(/\r\n/g, "\n").split("\n");
                if (zeilen[zeilen.length - 2].indexOf("Ende") >=0 && zeilen[zeilen.length - 2][4] != glNameNr) {
                    document.getElementById("Wirf").disabled = false;
                    glBinGeradeDran = 1;
                    if (zeilen.length - 2 > 2) {
                        glGegnerWurf = zeilen[zeilen.length - 3][0];
                        document.getElementById("ResultatG").innerHTML = glGegnerWurf;
                        // Feld Gegnerwurf
                        if (glNameNr == glErsterSpieler) {
                            if (glGegnerWurf > glMeinWurf)
                                document.getElementById("GegnerScore").innerHTML++;
                            else if (glGegnerWurf < glMeinWurf)
                                document.getElementById("MeinScore").innerHTML++;
                        }

                    }
                }

                ; //?? Spielefile lesen ob schon dran, dran setzen hidden weg

            }
            glLadenFertig = 1;
        }
    };
    ajaxObj.open("GET", url + "?wert=" + eingabe + "&wert2=" + eingabe2 + "&wert3=" + eingabe3, true);
    ajaxObj.send();
}

document.getElementById("Liste").innerHTML = "";
laden("pStart.php", "Name");
setInterval(fListe, 3000);
