<script setup lang="ts">
import { onMounted } from 'vue';
import * as THREE from 'three';

onMounted(() => {
    const scene = new THREE.Scene();
    const points=[];
    points.push(new THREE.Vector3(-10,0,0));
    points.push(new THREE.Vector3(500,10,0));


    const geometry = new THREE.BufferGeometry().setFromPoints(points);
    const material = new THREE.LineBasicMaterial( { color: 0x00ff00 } );

    const line=new THREE.Line(geometry,material);
    const camera = new THREE.PerspectiveCamera(75, window.innerWidth / window.innerHeight, 0.1, 1000);

    const renderer = new THREE.WebGLRenderer();
    renderer.setSize(window.innerWidth, window.innerHeight);
    document.body.appendChild(renderer.domElement);


    camera.position.z = 5;

    const animate = () => {
        requestAnimationFrame(animate);
        renderer.render(scene, camera);
    };

    animate();

    scene.add(line)

    camera.position.z = 5;
});
</script>

<template>
    <div id="three-container"></div>
</template>

<style scoped>
</style>
