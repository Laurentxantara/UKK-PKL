import { DropdownMenu, DropdownMenuContent, DropdownMenuItem, DropdownMenuLabel, DropdownMenuSeparator, DropdownMenuTrigger } from "@/components/ui/dropdown-menu"
import * as Icons from "lucide-react";
import { MobileSidebar } from "@/components/navigation/sidebar";
import { router, usePage } from "@inertiajs/react";

const handleLogout = () => {
    router.post("/logout");
};

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

const Navbar = () => {
    // const { props } = usePage()
    const pageProps = usePage().props as Record<string, unknown>;
    const auth = pageProps.auth as AuthProps;

    return (
        <nav className="bg-[#ffffff] fixed px-6 top-0 right-0 w-full max-w-full shadow-md z-10">
            <div className="flex justify-between md:justify-end w-full items-center md:px-4 py-1">
                <MobileSidebar/>
                    <div>
                    <DropdownMenu modal={false}>
                    <DropdownMenuTrigger className="text-black focus:outline-none">
                    {/* {profile && ( */}
                        <div className="flex items-center space-x-2 cursor-pointer p-2">
                            <img src="https://thumbs.dreamstime.com/b/default-avatar-profile-icon-social-media-user-vector-image-icon-default-avatar-profile-icon-social-media-user-vector-image-209162840.jpg"
                                alt=""
                                className="h-12 w-12 rounded-full object-cover border-2 border-[#E8F2F1] p-[1px]" />
                            <div className="flex flex-col text-start justify-center max-w-40">
                                <h1 className="hidden md:block truncate text-sm font-bold p-0"> {auth.user.name}</h1>
                                <p className="hidden md:block text-xs text-gray-600"> {auth.user.email}</p>
                            </div>
                        </div>
                    {/* )} */}

                    </DropdownMenuTrigger>
                    <DropdownMenuContent side="bottom" >
                        <DropdownMenuLabel>
                            <div className="flex items-center space-x-2 cursor-pointer">
                            <img src="https://thumbs.dreamstime.com/b/default-avatar-profile-icon-social-media-user-vector-image-icon-default-avatar-profile-icon-social-media-user-vector-image-209162840.jpg" 
                                alt=""
                                className="h-10 w-10 rounded-full object-cover " />
                            <div className="flex flex-col text-start justify-center">
                                <h1 className="text-sm font-bold p-0 max-w-35 truncate"> {auth.user.name}</h1>
                                <p className="text-xs"> {auth.user.email}</p>
                            </div>
                        </div>
                        </DropdownMenuLabel>
                        <DropdownMenuSeparator />
                        {/* <DropdownMenuItem className="cursor-pointer">
                            <Link href="/admin" className="flex items-center">
                                <Icons.Headset className="mr-2" />
                                    Panel Admin
                            </Link>
                        </DropdownMenuItem> */}
                        <DropdownMenuItem className="cursor-pointer" onSelect={handleLogout}>
                            <Icons.LogOut className="mr-2" />
                                Logout
                        </DropdownMenuItem>
                    </DropdownMenuContent>
                    </DropdownMenu>

                    </div>
            </div>
        </nav>
    );
}

export default Navbar;
