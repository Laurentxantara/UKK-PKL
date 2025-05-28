import { Link, Head } from "@inertiajs/react";
import stembayo from "../../assets/logo/stembayo.webp";

export default function PendingRolePage() {
    return (
        <>
        <Head title="Akses Ditolak" />
        <div className="min-h-screen flex flex-col bg-gray-800 items-center justify-center">
            <div className="text-center p-8">
                <div className="mb-6  flex justify-center">
                    <img src={stembayo} className="w-40" draggable='false' alt="" />
                </div>
                <h1 className="text-2xl font-bold mb-2">Akun Anda Belum Memiliki Hak Akses</h1>
                <p className="text-gray-400">
                    Silahkan hubungi admin untuk mendapatkan akses ke sistem.
                </p>
                <Link href={route('dashboard')}
                    className="mt-4 inline-block px-6 py-2 bg-[#106E69] text-white rounded-lg hover:bg-[#0d5955] transition-colors">
                    Lanjut
                </Link>
            </div>
        </div>
        </>
    );
}
