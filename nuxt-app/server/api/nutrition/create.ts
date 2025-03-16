import{Prisma,PrismaClient} from "@prisma/client";
const prisma=new PrismaClient();
export default defineEventHandler(async(event)=>{
    const body=await readBody(event)
    const response=await prisma.nutrition.create({
        data:{
            calories:body.calories,
            protein:body.protein,
            carbs:body.carbs,
            fat:body.carbs,
            user_id:body.user_id

        }
    })
    return response;

})