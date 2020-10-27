var initialProduct = 0;
var products = [
    {
        image: "/images/fruit.jpg",
        description:
            "variety of fresh and healthy fruits variety of fresh and healthy fruits variety of fresh and healthy fruits"
    },
    {
        image: "/images/hairOil.jpg",
        description:
            "variety of fresh and healthy fruits variety of fresh and healthy fruits variety of fresh and healthy fruits"
    },
    {
        image: "/images/soap.jpg",
        description:
            "variety of fresh and healthy fruits variety of fresh and healthy fruits variety of fresh and healthy fruits"
    },
    {
        image: "/images/dairy.jpg",
        description:
            "variety of fresh and healthy fruits variety of fresh and healthy fruits variety of fresh and healthy fruits"
    },
    {
        image: "/images/kukis.jpg",
        description:
            "variety of fresh and healthy fruits variety of fresh and healthy fruits variety of fresh and healthy fruits"
    },
    {
        image: "/images/conditioner.jpg",
        description:
            "variety of fresh and healthy fruits variety of fresh and healthy fruits variety of fresh and healthy fruits"
    },
    {
        image: "/images/candy.jpg",
        description:
            "variety of fresh and healthy fruits variety of fresh and healthy fruits variety of fresh and healthy fruits"
    },
    {
        image: "/images/shampoo.png",
        description:
            "variety of fresh and healthy fruits variety of fresh and healthy fruits variety of fresh and healthy fruits"
    }
];

var sample = "/images/fruit.jpg";

window.onload = function() {
    var leftAngle = document.querySelector(".fa-angle-left");
    var rightAngle = document.querySelector(".fa-angle-right");
    var centerProducts = document.querySelector(".centerProducts");
    leftAngle.addEventListener("click", function() {
        initialProduct = initialProduct - 1;

        buildProducts();
    });

    rightAngle.addEventListener("click", function() {
        initialProduct = initialProduct + 1;
        // var leftAngleElement =
        //     '<i style="font-size:50px; padding:100px 0" class="fas fa-angle-left"></i>';
        // var rightAngleElement =
        //     '<i style="font-size:50px; padding:100px 0" class="fas fa-angle-right"></i>';
        // centerProducts.innerHTML =
        //     leftAngleElement + buildProducts() + rightAngleElement;
        buildProducts();
    });
};

function buildProducts() {
    var productsElement = "";
    var centerProducts = document.querySelector(".centerProducts");
    var j = 0;
    for (i = initialProduct; i < initialProduct + 4; i++) {
        var index = i;
        if ((index < 0) & (index > -9)) {
            index = i + 8;
        }
        if ((index < -8) & (index > -17)) {
            index = i + 16;
        }
        if ((index > 7) & (index < 16)) {
            index = i - 8;
        }
        if ((index > 15) & (index > 24)) {
            index = i - 16;
        }
        console.log(index);
        // create image
        var image = document.createElement("img");
        image.src = products[index].image;
        //cretae paragraph
        var description = document.createElement("p");
        description.textContent = products[index].description;
        // append child
        var container = document.createElement("div");
        container.appendChild(image);
        container.appendChild(description);
        //replace the new product
        centerProducts.replaceChild(container, centerProducts.children[j + 1]);

        // var productElement = `<div><img  src=${products[index].image} alt="fruit"><p>${products[index].description}</p></div>`;
        // productsElement = productsElement + productElement;
        j = j + 1;
    }
}
