import axios from "axios";
import { problems,problemsList } from "../data/items";

export function getCategoriesProblems(f_date = '',s_date = '')
{
    const colorsCount = () => ({
        danger : 0,
        yellow : 0,
        warning: 0,
        neu    : 0,
        summ   : 0,
    });
    const data = {
        all      : {list : [], count : colorsCount(),total : 0},
        republic : {list : [], count : colorsCount(),total : 0},
        obl      : {list : [], count : colorsCount(),total : 0},
        city     : {list : [], count : colorsCount(),total : 0},
        '1'      : {list : [], count : colorsCount(),total : 0},
        '2'      : {list : [], count : colorsCount(),total : 0},
        '3'      : {list : [], count : colorsCount(),total : 0},
        '4'      : {list : [], count : colorsCount(),total : 0},
        '5'      : {list : [], count : colorsCount(),total : 0},
        '6'      : {list : [], count : colorsCount(),total : 0},
    };

    const query = new URLSearchParams({
        visible : 1,
        f_date : f_date,
        s_date : s_date,
    }).toString();

    axios.get(`/api/main?${query}`)
        .then(res => {
            data.all.list = res.data;
            res.data.forEach(problem => {
               const level = problem.level;
               const color = problem.color;

               if(data[level]){
                    data[level].list.push(problem);
                    if(data[level].count[color] !== undefined){
                        data[level].count[color] += 1;

                        if(color !== 'neu'){
                            data[level].count.summ += 1;
                        }
                    }
                    data[level].total += 1;
               }

               if(data.all.count[color] !== undefined){
                    data.all.count[color] += 1;

                    if(color !== 'neu'){
                        data.all.count.summ += 1;
                    }
                    data.all.total += 1;
               }

            })
            problems.value = data;
        })
        .catch( error => {console.error('Ошибка при получений проблемных вопросов',error);})
}
export function getLevelsWidthProblemsList(level = '',f_date = '',s_date = '')
{
    const query = new URLSearchParams({
        visible : 1,
        levels : level == 'all' ? '' : level,
        f_date : f_date,
        s_date : s_date,
    }).toString();

    const props = {
        data : [],
        outbreaks : 0,
        total : 0,
        level : level == 'all' ? level : '',
    }

    axios.get(`/api/main?${query}`)
        .then(res => {
            res.data.forEach(problem => {
                const level = problem.level;
                const color = problem.color;
                if(props.level !== 'all') props.level = level;

                props.data.push(problem)

                if(color == 'yellow' || color == 'danger' || color == "warning"){
                    props.outbreaks += 1;
                }
                props.total += 1;
             })
            problemsList.value = props;
        })
        .catch( error => {console.error('Ошибка при получений проблемных вопросов',error);})
}