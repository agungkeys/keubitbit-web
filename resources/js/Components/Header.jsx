import { Link } from "@inertiajs/react";
export default function Header(props) {
    const { menu } = props; 
    return (
        <div className="bg-base-100 border-b-4 border-dashed border-base-content ">
            <div className="container grid md:flex navbar justify-center">
                <div className="block md:flex-1 text-center md:text-left pt-2 md:pt-0">
                    <img
                        className="w-36 mx-auto md:mx-0"
                        src="https://res.cloudinary.com/domqavi1p/image/upload/v1690468533/keubitbit-long_hidyuv.svg"
                    />
                </div>
                <div className="flex-none">
                    <ul className="menu menu-horizontal md:gap-1 md:my-1">
                        {menu.map((item) => (
                            <li key={item.id}>
                                <Link
                                    href={item.link}
                                    className="hover:text-white text-sm md:text-base font-normal md:font-semibold px-2 py-1 md:py-2"
                                >
                                    {item.name}
                                </Link>
                            </li>
                        ))}
                    </ul>
                </div>
            </div>
        </div>
    );
}
