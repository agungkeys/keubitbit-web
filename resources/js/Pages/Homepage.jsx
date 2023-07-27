import { Link, Head } from "@inertiajs/react";
import React, { useState } from "react";
import Footer from "../Components/Footer";
import Header from "../Components/Header";

const Homepage = () => {
    const menus = [
        {
            id: 0,
            name: "Home",
            link: "/home",
        },
        {
            id: 1,
            name: "About",
            link: "/about",
        },
        {
            id: 2,
            name: "Video",
            link: "/video",
        },
        {
            id: 3,
            name: "Music",
            link: "/music",
        },
        {
            id: 4,
            name: "Tour",
            link: "/tour",
        },
        {
            id: 5,
            name: "Contact",
            link: "/contact",
        },
    ];
    return (
        <>
            <Head>
                <meta charset="UTF-8" />
                <title>Keubitbit Aceh Ethnic Music Official Website</title>
                <link rel="icon" type="image/x-icon" href="https://res.cloudinary.com/domqavi1p/image/upload/v1690457837/favicon_uakjw6.ico" />
                <meta name="description" content="Everything about gigs, glbums of Keubitbit Aceh Ethnic Music" />
                <meta name="keywords" content="Keubitbit, Ethnic Music, Keubitbit Indonesia" />
                <meta name="author" content="Agung Kurniawan" />
                <meta name="viewport" content="width=device-width, initial-scale=1.0" />
            </Head>
            <Header menu={menus} />
            <div
                className="w-full bg-center bg-repeat md:bg-no-repeat bg-contain md:bg-cover"
                style={{
                    backgroundImage: `linear-gradient(to top, rgba(0, 0, 0, 1), rgba(0, 0, 0, 0.6), rgba(0, 0, 0, 0.4), rgba(0, 0, 0, .1)), url(https://res.cloudinary.com/domqavi1p/image/upload/v1690457739/keubitbit_p9zx93.webp)`,
                }}
            >
                <div className="hero min-h-screen bg-base">
                    <div className="hero-content text-center">
                        <div className="max-w-md">
                            <h1 className="text-5xl font-bold">
                                Holaa Keubitbit People
                            </h1>
                            <p className="py-6 text-2xl">
                                We are still under construction.
                            </p>
                            <span className="loading loading-infinity loading-lg"></span>
                        </div>
                    </div>
                </div>
            </div>
            <Footer />
        </>
    );
};

export default Homepage;
