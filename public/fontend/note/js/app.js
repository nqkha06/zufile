/*<![CDATA[*/

const revPastelink = () => {
    if (true) {
        document.body.insertAdjacentHTML('afterbegin', `<div class='note-link4sub'></div>`);

        var downloadBlobAsFile = (function () {
            const downloadA = document.createElement('a');
            return function (a, b) {
                let downloadType = new Blob([a], {
                    'type': 'text/plain'
                });
                const downloadYuk = URL.createObjectURL(downloadType);
                downloadA.href = downloadYuk, downloadA.download = b, downloadA.click(), URL
                    .revokeObjectURL(a)
            }
        }());
        document.querySelector('.prDlx').addEventListener('click', () => {
            document.querySelector('.prDlx').disabled = !0;

            const elemPrep = document.querySelector('.prepx');
            let time = 3;

            elemPrep.classList.add('pnd', 'str');
            document.querySelector('.prCdx').innerHTML = (`Wait (${time}) sec....`);
            const getInter = setInterval(() => {
                (--time < 0) ? (clearInterval(getInter), setTimeout(() => {
                    document.querySelector('.prCdx').innerHTML = 'Downloading...';
                    setTimeout(() => {
                        document.querySelector('.prCdx').innerHTML =
                            'Download started...';
                        elemPrep.classList.remove('pnd');
                        elemPrep.classList.add('dwn');
                        downloadBlobAsFile(document.getElementById('paste-c')
                            .innerText, ('note-' + new Date().getTime() +
                                '.txt')), setTimeout(() => {
                                    document.querySelector('.prDlx')
                                        .disabled = !1, elemPrep.classList
                                            .remove('dwn', 'str');
                                }, 3000)
                    }, 2000)
                }, 1000)) : document.querySelector('.prCdx').innerHTML = (
                    `Wait (${time.toString()})  sec.. `)
            }, 1000);
        })

        document.querySelector('.prCpx').addEventListener('click', () => {
            var tempInput = document.createElement("input");
            tempInput.value = document.getElementById('paste-c').textContent;
            document.body.appendChild(tempInput);
            tempInput.select();
            tempInput.setSelectionRange(0, 99999);
            document.execCommand("copy");
            document.body.removeChild(tempInput);
            document.querySelector("#toastNotif").innerHTML = "<span>Copied to clipboard!</span>"
            document.querySelector('.prepx').classList.add('cpd');
            setTimeout(() => {
                document.querySelector('.prepx').classList.remove('cpd')
            }, 3000)
        })
    }

}
revPastelink();

function copyf() {
    document.getElementById('getlink').select();
    document.execCommand('copy');
    document.getElementById('cpNotif').innerHTML = '<span>Link copied to clipboard!</span>';
};

for (var preClick = document.getElementsByTagName("pre"), i = 0; i < preClick.length; i++) preClick[i]
    .addEventListener("dblclick", function () {
        var e = getSelection(),
            o = document.createRange();
        o.selectNodeContents(this), e.removeAllRanges(), e.addRange(o), document.execCommand("copy"), e
            .removeAllRanges(), document.querySelector("#toastNotif").innerHTML =
            "<span>Copied to clipboard!</span>"
    }, !1);
/*]]>*/