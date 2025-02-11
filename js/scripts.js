const shapes = document.querySelectorAll(".shape");
let selectedShape = null;
let offsetX = 0;
let offsetY = 0;

shapes.forEach(shape => {
    shape.addEventListener("mousedown", selectShape);
});

document.addEventListener("mousemove", dragShape);
document.addEventListener("mouseup", releaseShape);

function selectShape(event) {
    selectedShape = event.target;
    offsetX = event.clientX - selectedShape.getBoundingClientRect().left;
    offsetY = event.clientY - selectedShape.getBoundingClientRect().top;
}

function dragShape(event) {
    if (selectedShape) {
        const x = event.clientX - offsetX;
        const y = event.clientY - offsetY;
        selectedShape.style.left = `${x}px`;
        selectedShape.style.top = `${y}px`;
    }
}

function releaseShape() {
    selectedShape = null;
}
