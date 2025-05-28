import Navbar from "../navigation/navbar";
import WavingHand from "../../../assets/logo/waving-hand.jpg";
import { usePage } from "@inertiajs/react";
// import { PageProps } from "@inertiajs/core";

type AuthProps = {
  user: {
    id: number;
    name: string;
    email: string;
    profile: string;
    roles: string[];
    permissions: string[];
  };
  
};

const Dashboard = () => {
    const pageProps = usePage().props as Record<string, unknown>;
    const auth = pageProps.auth as AuthProps;   

    return (
        <div className="relative w-full bg-[#E8F2F1]">
        <Navbar/>
            <div className="p-4 pt-25 md:pl-68 min-h-screen ">
                <div className="bg-[#106E69] p-4 rounded-2xl w-fit max-w-2xl">
                    <h1 className="font-semibold">Selamat Datang!</h1>
                    <h1 className="text-2xl font-extrabold">{auth.user?.name}</h1>
                </div>

                <div className="absolute top-20 right-0 bg-white rounded-l-2xl mt-4 p-2 hidden md:flex">
                    <div>
                        <img src={WavingHand} className="w-15" alt="" draggable='false'/>
                    </div>
                    <div className="flex flex-col text-start justify-center">
                        <h1 className="text-sm font-semibold p-0 text-black">Anda Login Sebagai</h1>
                        <p className="text-xs text-[#106E69]">{auth.user?.roles}</p>
                    </div>
                </div>
            </div>
        </div>
    );
};

export default Dashboard;
