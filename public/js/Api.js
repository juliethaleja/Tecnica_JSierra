function TableI(Id) {
    let body = document.getElementById("TbodyRMApi");
    let bodys = "";
    fetch("/character/page/" + Id)
        .then((response) => response.text())
        .then((data) => {
            const json = JSON.parse(data);
            const datos = [json];
            datos.forEach((element) => {
                let dats = [element.data];
                console.log(element);
                dats.forEach((info) => {
                    const ides = info.map(function (info) {
                        return info.id;
                    });
                    const name = info.map(function (info) {
                        return info.name;
                    });
                    const status = info.map(function (info) {
                        return info.status;
                    });
                    const species = info.map(function (info) {
                        return info.species;
                    });

                    for (let i = 0; i < info.length; i++) {
                        bodys += `<tr>
                        <td>${ides[i]}</td>
                        <td>${name[i]}</td>
                        <td>${status[i]}</td>
                        <td>${species[i]}</td>
                        <td> <button ide="${ides[i]}"class=" viewdetails btn btn-primary"><i class="fa-solid fa-circle-info"></i></button></td>
                        </tr>`;
                    }
                });
                body.innerHTML = bodys;
            });
        });
}
$(document).ready(function () {
    $("#RMApi").on("click", ".viewdetails", function () {
        var deid = $(this).attr("ide");
        console.log(deid);
        fetch("/character/" + deid)
            .then((response) => response.text())
            .then((data) => {
                const json = JSON.parse(data);
                const datos = [json];
                console.log(datos);
                datos.forEach((element) => {
                    let dets = [element.detail];
                    dets.forEach((info) => {
                        let detailChart = {
                            id: info.id,
                            name: info.name,
                            species: info.species,
                            status: info.status,
                            type: info.type,
                            gender: info.gender,
                            img: info.image,
                        };
                        document.getElementById("id_det").textContent =
                            detailChart.id;
                        document.getElementById("name_det").textContent =
                            detailChart.name;
                        document.getElementById("status_det").textContent =
                            detailChart.status;
                        document.getElementById("Species_det").textContent =
                            detailChart.species;
                        document.getElementById("type_detail").textContent =
                            detailChart.type;
                        document.getElementById("gender_det").textContent =
                            detailChart.gender;
                        document.getElementById(
                            "img_det"
                        ).innerHTML = `<img  src="${detailChart.img}" class="img-fluid" >`;

                        let dorigin = [info.origin];
                        dorigin.forEach((origin) => {
                            let detailOrigin = {
                                name: origin.name,
                                url: origin.url,
                            };
                            document.getElementById("Nameo_det").textContent =
                                detailOrigin.name;
                            document.getElementById("url_det").textContent =
                                detailOrigin.url;
                        });
                    });
                });
                $("#DetailCharacter").modal("show");
            });
    });
    $("#DetailCharacter").on("click", ".close", function () {
        $("#DetailCharacter").modal("hide");
    });
    $("#RMdata").on("click", ".editdetails", function () {
        let deid = $(this).attr("ide");
        console.log(edit_modal);
        fetch("/characterbd/" + deid)
            .then((response) => response.text())
            .then((data) => {
                const json = JSON.parse(data);
                const datos = [json];
                console.log(datos);
                datos.forEach((element) => {
                    let dets = [element];
                    console.log(element);
                    dets.forEach((info) => {
                        let editChart = {
                            name: info.name,
                            species: info.species,
                            status: info.status,
                            type: info.type,
                            gender: info.gender,
                            img: info.image,
                        };
                        document.getElementById("name_edit").value =
                            editChart.name;
                        document.getElementById("status_edit").value =
                            editChart.status;
                        document.getElementById("species_edit").value =
                            editChart.species;
                        document.getElementById("type_edit").value =
                            editChart.type;
                        document.getElementById("gender_edit").value =
                            editChart.gender;
                        document.getElementById("img_edit").innerHTML = `<img  src="${editChart.img}" class="img-fluid" >`;
                        let dorigin = [info.origin];
                        dorigin.forEach((origin) => {
                            let editOrigin = {
                                name: origin.name,
                                url: origin.url,
                            };
                            document.getElementById("Nameo_edit").value =
                                editOrigin.name;
                            document.getElementById("Url_edit").value =
                                editOrigin.url;
                        });
                    });
                });
                document.getElementById("edit_modal").setAttribute("deid", deid)
                $("#EditCharacter").modal("show");
            });
    });
    $("#EditCharacter").on("click", ".close", function () {
        $("#EditCharacter").modal("hide");
    });
        $("#edit_modal").on("click",  function () {
        let deid = $(this).attr("deid");



            UpdC(deid);
            UpdO(deid);
        $("#EditCharacter").modal("hide");
    });
});
function Pagination() {
    const paginationNumbers = document.getElementById("pagination-numbers");
    const appendPageNumber = (index) => {
        const pageNumber = document.createElement("button");
        pageNumber.className = "pagination-number";
        pageNumber.innerHTML = index;
        pageNumber.setAttribute("page-index", index);
        pageNumber.setAttribute("aria-label", "Page " + index);

        paginationNumbers.appendChild(pageNumber);
    };

    const getPaginationNumbers = () => {
        for (let i = 1; i <= 5; i++) {
            appendPageNumber(i);
        }
    };
    const handleActivePageNumber = () => {
        document.querySelectorAll(".pagination-number").forEach((button) => {
            button.classList.remove("active");
            const pageIndex = Number(button.getAttribute("page-index"));
            if (pageIndex == currentPage) {
                button.classList.add("active");
            }
        });
    };

    const setCurrentPage = (pageNum) => {
        currentPage = pageNum;
        handleActivePageNumber();

        TableI(pageNum);
    };
    setCurrentPage(1);
    window.addEventListener("load", () => {
        getPaginationNumbers();
        document.querySelectorAll(".pagination-number").forEach((button) => {
            const pageIndex = Number(button.getAttribute("page-index"));

            if (pageIndex) {
                button.addEventListener("click", () => {
                    TableI(pageIndex);
                    setCurrentPage(pageIndex);
                });
            }
        });
    });
}
function SaveBd() {
    let i=1;
    do {
        const data = {
            _method: 'post',
            id: i,
        };
        let payload = new FormData();
        payload.append("json", JSON.stringify(data));

        const options = {

            method: "POST",
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            body: JSON.stringify(data)

        };
        fetch("stroedCharacter" , options)
        .then((response) => response.text())
        .then((data) => {
            const json = JSON.parse(data);
            const datos = [json];
            console.log(datos);

        });
        i ++;
    } while (i<=5){
        window.location.reload()
    };

}
function UpdC(id) {
    let namec = document.getElementById("name_edit").value;
    let statusc = document.getElementById("status_edit").value;
    let species = document.getElementById("species_edit").value;
    let type = document.getElementById("type_edit").value;
    let gender = document.getElementById("gender_edit").value;
    const dataC = {
        _method: 'post',
        id: id,
        name: namec,
        species: species,
        status: statusc,
        type: type,
        gender: gender,

    };

    let payload = new FormData();
    payload.append("json", JSON.stringify(dataC));

    const optionsC = {

        method: "POST",
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        body: JSON.stringify(dataC)

    };

    fetch("UpdCharacter" , optionsC)
    .then((response) => response.text())
    .then((data) => {
        window.location.reload()
    });

}
function UpdO(id) {
    let nameo = document.getElementById("Nameo_edit").value;
    let url = document.getElementById("Url_edit").value;
    const dataO = {
        _method: 'post',
        id: id,
        nameo: nameo,
        url: url,

    };
    let payload = new FormData();
    payload.append("json", JSON.stringify(dataO));


    const optionsO = {

        method: "POST",
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        body: JSON.stringify(dataO)

    };

    fetch("UpdOrigin" , optionsO)
    .then((response) => response.text())
    .then((data) => {
        console.log(data);

    });
}
function eventos() {
    document.getElementById("savebd").addEventListener("click",SaveBd)
    Pagination();
}
eventos();
